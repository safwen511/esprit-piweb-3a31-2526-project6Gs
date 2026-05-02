<?php

namespace App\Repository;

use App\Entity\FaceCredential;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FaceCredential>
 */
class FaceCredentialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaceCredential::class);
    }

    /** @return FaceCredential[] */
    public function findForUser(User $user): array
    {
        return $this->findBy(['user' => $user]);
    }

    /** @return FaceCredential[] */
    public function findForLoginEmail(string $email): array
    {
        return $this->createQueryBuilder('credential')
            ->innerJoin('credential.user', 'user')
            ->andWhere('user.email = :email')
            ->setParameter('email', mb_strtolower(trim($email)))
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array{id: int, userId: int, descriptor: list<float>}|null
     */
    public function findLoginCandidateByEmail(string $email): ?array
    {
        $row = $this->getEntityManager()->getConnection()->fetchAssociative(
            'SELECT fc.id, fc.user_id AS userId, fc.descriptor
             FROM face_credential fc
             INNER JOIN `user` u ON fc.user_id = u.id
             WHERE u.email = :email
             LIMIT 1',
            ['email' => mb_strtolower(trim($email))],
        );

        if ($row === false) {
            return null;
        }

        $descriptor = json_decode((string) $row['descriptor'], true);
        if (!is_array($descriptor)) {
            return null;
        }

        return [
            'id' => (int) $row['id'],
            'userId' => (int) $row['userId'],
            'descriptor' => array_values(array_map(static fn (mixed $value): float => (float) $value, $descriptor)),
        ];
    }

    public function touchLastUsedAt(FaceCredential $credential): void
    {
        $id = $credential->getId();
        if ($id === null) {
            return;
        }

        $this->getEntityManager()->getConnection()->update(
            'face_credential',
            ['last_used_at' => new \DateTimeImmutable()],
            ['id' => $id],
            [Types::DATETIME_IMMUTABLE, Types::INTEGER],
        );
    }

    public function touchLastUsedAtById(int $credentialId): void
    {
        if ($credentialId <= 0) {
            return;
        }

        $this->getEntityManager()->getConnection()->update(
            'face_credential',
            ['last_used_at' => new \DateTimeImmutable()],
            ['id' => $credentialId],
            [Types::DATETIME_IMMUTABLE, Types::INTEGER],
        );
    }
}
