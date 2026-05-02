<?php

declare(strict_types=1);

/*
 * PHPStan before/after examples from our cleanup.
 *
 * This file is intentionally written like normal PHP code so it is easy to
 * screenshot. It is under tools/, not src/, so PHPStan does not analyze these
 * intentionally bad "before" examples.
 */

namespace Doctrine\ORM\Mapping {
    #[\Attribute(\Attribute::TARGET_CLASS)]
    final class Entity
    {
        public function __construct(public ?string $repositoryClass = null)
        {
        }
    }

    #[\Attribute(\Attribute::TARGET_PROPERTY)]
    final class Id
    {
    }

    #[\Attribute(\Attribute::TARGET_PROPERTY)]
    final class GeneratedValue
    {
    }

    #[\Attribute(\Attribute::TARGET_PROPERTY)]
    final class Column
    {
        /**
         * @param array<string, mixed> $options
         */
        public function __construct(
            public ?int $length = null,
            public array $options = [],
        ) {
        }
    }
}

namespace PhpStanExamples\Shared {
    class Response
    {
    }

    final class RedirectResponse extends Response
    {
    }

    final class AccessDeniedException extends \RuntimeException
    {
    }

    final class User
    {
        public function getId(): ?int
        {
            return 10;
        }
    }

    final class Rendezvous
    {
        private ?User $client = null;
        private ?\DateTime $appointmentDate = null;
        private ?\DateTime $appointmentTime = null;

        public function setClient(User $client): void
        {
            $this->client = $client;
        }

        public function getAppointmentDate(): ?\DateTime
        {
            return $this->appointmentDate;
        }

        public function getAppointmentTime(): ?\DateTime
        {
            return $this->appointmentTime;
        }
    }

    final class Repository
    {
        /**
         * @param array<string, mixed> $criteria
         */
        public function count(array $criteria): int
        {
            return 0;
        }
    }

    interface EntityManagerInterface
    {
        public function getRepository(string $className): Repository;
    }

    final class ReviewRepository
    {
        /**
         * @return array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles: float}
         */
        public function getStatsParVet(int $vetId): array
        {
            return [
                'note_moyenne' => 4.8,
                'nombre_avis' => 12,
                'taux_satisfaction' => 96,
                'etoiles' => 5.0,
            ];
        }
    }

    final class Query
    {
        /**
         * @return array<int|string, mixed>
         */
        public function getSingleColumnResult(): array
        {
            return [7, 12, 18];
        }
    }

    final class Form
    {
        public function get(string $name): FormField
        {
            return new FormField();
        }
    }

    final class FormField
    {
        public function getData(): mixed
        {
            return null;
        }
    }

    final class UploadedFile
    {
    }

    interface SluggerInterface
    {
    }

    final class Product
    {
        public function setImage(string $image): void
        {
        }
    }
}

namespace PhpStanExamples\Example01NullableSymfonyUser {
    use PhpStanExamples\Shared\AccessDeniedException;
    use PhpStanExamples\Shared\RedirectResponse;
    use PhpStanExamples\Shared\Rendezvous;
    use PhpStanExamples\Shared\Response;
    use PhpStanExamples\Shared\User;

    // EXAMPLE 01: Nullable Symfony user
    // BEFORE: getUser() can be null, but setClient() requires User.
    final class BeforeBookingController
    {
        public function book(): Response
        {
            $client = $this->getUser();

            $rendezvous = new Rendezvous();
            $rendezvous->setClient($client);

            return $this->redirectToRoute('client_dashboard');
        }

        private function getUser(): ?User
        {
            return null;
        }

        private function redirectToRoute(string $route): RedirectResponse
        {
            return new RedirectResponse();
        }
    }

    // AFTER: guard once, then the rest of the method receives a real User.
    final class AfterBookingController
    {
        public function book(): Response
        {
            $client = $this->getAuthenticatedClient();

            $rendezvous = new Rendezvous();
            $rendezvous->setClient($client);

            return $this->redirectToRoute('client_dashboard');
        }

        private function getAuthenticatedClient(): User
        {
            $user = $this->getUser();

            if (!$user instanceof User) {
                throw new AccessDeniedException('Client account required.');
            }

            return $user;
        }

        private function getUser(): ?User
        {
            return new User();
        }

        private function redirectToRoute(string $route): RedirectResponse
        {
            return new RedirectResponse();
        }
    }
}

namespace PhpStanExamples\Example02NullableDateAccess {
    use PhpStanExamples\Shared\Rendezvous;

    // EXAMPLE 02: Nullable date/time access
    // BEFORE: clone/format can crash if either field is null.
    final class BeforeCalendarMapper
    {
        public function map(Rendezvous $rdv): \DateTimeImmutable
        {
            return \DateTimeImmutable::createFromMutable(
                (clone $rdv->getAppointmentDate())->setTime(
                    (int) $rdv->getAppointmentTime()->format('H'),
                    (int) $rdv->getAppointmentTime()->format('i'),
                ),
            );
        }
    }

    // AFTER: keep nullable values away from DateTime methods.
    final class AfterCalendarMapper
    {
        public function map(Rendezvous $rdv): ?\DateTimeImmutable
        {
            $appointmentDate = $rdv->getAppointmentDate();
            $appointmentTime = $rdv->getAppointmentTime();

            if (!$appointmentDate instanceof \DateTime || !$appointmentTime instanceof \DateTime) {
                return null;
            }

            return \DateTimeImmutable::createFromMutable(
                (clone $appointmentDate)->setTime(
                    (int) $appointmentTime->format('H'),
                    (int) $appointmentTime->format('i'),
                ),
            );
        }
    }
}

namespace PhpStanExamples\Example03TypedHelpers {
    use PhpStanExamples\Shared\EntityManagerInterface;
    use PhpStanExamples\Shared\Rendezvous;
    use PhpStanExamples\Shared\ReviewRepository;
    use PhpStanExamples\Shared\User;

    // EXAMPLE 03: Missing parameter and return value types
    // BEFORE: parameters are mixed, and array values are undocumented.
    final class BeforeVetStatsBuilder
    {
        public function buildVetStats($em, $reviewRepository, $vet): array
        {
            return [
                'pending' => $em->getRepository(Rendezvous::class)->count(['vet' => $vet]),
                'reviews' => $reviewRepository->getStatsParVet($vet->getId()),
            ];
        }
    }

    // AFTER: typed dependencies plus an exact return shape.
    final class AfterVetStatsBuilder
    {
        /**
         * @return array{
         *     pending: int,
         *     reviews: array{
         *         note_moyenne: float,
         *         nombre_avis: int,
         *         taux_satisfaction: float|int,
         *         etoiles: float
         *     }
         * }
         */
        public function buildVetStats(
            EntityManagerInterface $em,
            ReviewRepository $reviewRepository,
            User $vet,
        ): array {
            return [
                'pending' => $em->getRepository(Rendezvous::class)->count(['vet' => $vet]),
                'reviews' => $reviewRepository->getStatsParVet((int) $vet->getId()),
            ];
        }
    }
}

namespace PhpStanExamples\Example04DoctrineLists {
    use PhpStanExamples\Shared\Query;

    // EXAMPLE 04: list<int> returned from Doctrine scalar queries
    // BEFORE: array_map() preserves keys, so PHPStan sees array<int>.
    final class BeforePostReportRepository
    {
        /**
         * @return list<int>
         */
        public function findReportedPostIdsForUser(Query $query): array
        {
            return array_map(
                static fn (mixed $value): int => (int) $value,
                $query->getSingleColumnResult(),
            );
        }
    }

    // AFTER: array_values() reindexes the array into a real list.
    final class AfterPostReportRepository
    {
        /**
         * @return list<int>
         */
        public function findReportedPostIdsForUser(Query $query): array
        {
            return array_values(array_map(
                static fn (mixed $value): int => (int) $value,
                $query->getSingleColumnResult(),
            ));
        }
    }
}

namespace PhpStanExamples\Example05UploadedFiles {
    use PhpStanExamples\Shared\Form;
    use PhpStanExamples\Shared\Product;
    use PhpStanExamples\Shared\SluggerInterface;
    use PhpStanExamples\Shared\UploadedFile;

    // EXAMPLE 05: Uploaded file typing
    // BEFORE: getData() is mixed, but handleImageUpload() expects a file.
    final class BeforeProductController
    {
        public function save(Form $form, Product $product, SluggerInterface $slugger): void
        {
            $image = $form->get('image')->getData();

            if ($image !== null) {
                $product->setImage($this->handleImageUpload($image, $slugger));
            }
        }

        private function handleImageUpload($image, SluggerInterface $slugger): string
        {
            return 'uploaded-image.jpg';
        }
    }

    // AFTER: only call the helper when the value is actually UploadedFile.
    final class AfterProductController
    {
        public function save(Form $form, Product $product, SluggerInterface $slugger): void
        {
            $image = $form->get('image')->getData();

            if ($image instanceof UploadedFile) {
                $product->setImage($this->handleImageUpload($image, $slugger));
            }
        }

        private function handleImageUpload(UploadedFile $image, SluggerInterface $slugger): string
        {
            return 'uploaded-image.jpg';
        }
    }
}

namespace PhpStanExamples\Example06NonNullDefaultFields {
    use Doctrine\ORM\Mapping as ORM;

    // EXAMPLE 06: Non-null default entity field
    // BEFORE: category is nullable even though it always has a default.
    final class BeforeProductEntity
    {
        #[ORM\Column(length: 50, options: ['default' => 'medical'])]
        private ?string $category = 'medical';

        public function getCategory(): string
        {
            return $this->category ?? 'medical';
        }
    }

    // AFTER: the property type matches the real lifecycle.
    final class AfterProductEntity
    {
        #[ORM\Column(length: 50, options: ['default' => 'medical'])]
        private string $category = 'medical';

        public function getCategory(): string
        {
            return $this->category;
        }
    }
}

namespace PhpStanExamples\Example07DoctrineGeneratedIds {
    use Doctrine\ORM\Mapping as ORM;

    // EXAMPLE 07: Doctrine-generated IDs
    // BEFORE: plain PHPStan sees no assignment to int, because Doctrine writes it.
    #[ORM\Entity]
    final class BeforeDoctrineEntity
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        public function getId(): ?int
        {
            return $this->id;
        }
    }

    // AFTER: keep the entity code correct, and teach PHPStan about Doctrine:
    //
    // phpstan.dist.neon
    // includes:
    //     - vendor/phpstan/phpstan-doctrine/extension.neon
    #[ORM\Entity]
    final class AfterDoctrineEntity
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        public function getId(): ?int
        {
            return $this->id;
        }
    }
}
