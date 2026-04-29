<?php

namespace App\Repository;

use App\Entity\User;
use App\Model\UserSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return array{
     *     allUsers: int,
     *     activeUsers: int,
     *     verifiedUsers: int,
     *     admins: int,
     *     pendingVeteranApplicants: int
     * }
     */
    public function getDashboardStats(): array
    {
        $row = $this->createQueryBuilder('u')
            ->select('COUNT(u.id) AS allUsers')
            ->addSelect('SUM(CASE WHEN u.isActive = true THEN 1 ELSE 0 END) AS activeUsers')
            ->addSelect('SUM(CASE WHEN u.isVerified = true THEN 1 ELSE 0 END) AS verifiedUsers')
            ->addSelect("SUM(CASE WHEN u.roles LIKE :adminRole THEN 1 ELSE 0 END) AS admins")
            ->addSelect('SUM(CASE WHEN u.isVeteranApplicant = true AND u.isVeteranApproved = false THEN 1 ELSE 0 END) AS pendingVeteranApplicants')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->getQuery()
            ->getSingleResult();

        return [
            'allUsers' => (int) ($row['allUsers'] ?? 0),
            'activeUsers' => (int) ($row['activeUsers'] ?? 0),
            'verifiedUsers' => (int) ($row['verifiedUsers'] ?? 0),
            'admins' => (int) ($row['admins'] ?? 0),
            'pendingVeteranApplicants' => (int) ($row['pendingVeteranApplicants'] ?? 0),
        ];
    }

    public function countVerified(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.isVerified = :verified')
            ->setParameter('verified', true)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countActive(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.isActive = :active')
            ->setParameter('active', true)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countVeteranApplicantsPending(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.isVeteranApplicant = :applicant')
            ->andWhere('u.isVeteranApproved = :approved')
            ->setParameter('applicant', true)
            ->setParameter('approved', false)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countAdmins(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.roles LIKE :adminRole')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countActiveAdmins(): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.roles LIKE :adminRole')
            ->andWhere('u.isActive = :active')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->setParameter('active', true)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return list<User>
     */
    public function findRecent(int $limit = 5): array
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return list<User>
     */
    public function findPendingVeteranApplicants(int $limit = 6): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.isVeteranApplicant = :applicant')
            ->andWhere('u.isVeteranApproved = :approved')
            ->setParameter('applicant', true)
            ->setParameter('approved', false)
            ->orderBy('u.createdAt', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return list<User>
     */
    public function searchByFilters(UserSearchData $searchData, int $limit = 50): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->andWhere('u.roles NOT LIKE :adminRole')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults($limit);

        $term = trim((string) $searchData->term);
        if ($term !== '') {
            $queryBuilder
                ->andWhere('LOWER(u.firstName) LIKE :term OR LOWER(u.lastName) LIKE :term OR LOWER(u.email) LIKE :term')
                ->setParameter('term', '%'.mb_strtolower($term).'%');
        }

        match ($searchData->status) {
            UserSearchData::STATUS_ACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', true),
            UserSearchData::STATUS_INACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', false),
            UserSearchData::STATUS_VERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', true),
            UserSearchData::STATUS_UNVERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', false),
            UserSearchData::STATUS_VETERAN_PENDING => $queryBuilder
                ->andWhere('u.isVeteranApplicant = :isVeteranApplicant')
                ->andWhere('u.isVeteranApproved = :isVeteranApproved')
                ->setParameter('isVeteranApplicant', true)
                ->setParameter('isVeteranApproved', false),
            default => null,
        };

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return list<array{
     *     id: int,
     *     email: string,
     *     firstName: string,
     *     lastName: string,
     *     isActive: bool,
     *     isVerified: bool,
     *     isVeteranApplicant: bool,
     *     isVeteranApproved: bool
     * }>
     */
    public function searchAdminUserSummaries(UserSearchData $searchData, int $limit = 40, int $offset = 0): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->select([
                'u.id AS id',
                'u.email AS email',
                'u.firstName AS firstName',
                'u.lastName AS lastName',
                'u.isActive AS isActive',
                'u.isVerified AS isVerified',
                'u.isVeteranApplicant AS isVeteranApplicant',
                'u.isVeteranApproved AS isVeteranApproved',
            ])
            ->andWhere('u.roles NOT LIKE :adminRole')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->orderBy('u.createdAt', 'DESC')
            ->setFirstResult(max(0, $offset))
            ->setMaxResults($limit);

        $term = trim((string) $searchData->term);
        if ($term !== '') {
            $queryBuilder
                ->andWhere('LOWER(u.firstName) LIKE :term OR LOWER(u.lastName) LIKE :term OR LOWER(u.email) LIKE :term')
                ->setParameter('term', '%'.mb_strtolower($term).'%');
        }

        match ($searchData->status) {
            UserSearchData::STATUS_ACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', true),
            UserSearchData::STATUS_INACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', false),
            UserSearchData::STATUS_VERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', true),
            UserSearchData::STATUS_UNVERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', false),
            UserSearchData::STATUS_VETERAN_PENDING => $queryBuilder
                ->andWhere('u.isVeteranApplicant = :isVeteranApplicant')
                ->andWhere('u.isVeteranApproved = :isVeteranApproved')
                ->setParameter('isVeteranApplicant', true)
                ->setParameter('isVeteranApproved', false),
            default => null,
        };

        $rows = $queryBuilder->getQuery()->getArrayResult();

        return array_values(array_map(static fn (array $row): array => [
            'id' => (int) $row['id'],
            'email' => (string) $row['email'],
            'firstName' => (string) $row['firstName'],
            'lastName' => (string) $row['lastName'],
            'isActive' => (bool) $row['isActive'],
            'isVerified' => (bool) $row['isVerified'],
            'isVeteranApplicant' => (bool) $row['isVeteranApplicant'],
            'isVeteranApproved' => (bool) $row['isVeteranApproved'],
        ], $rows));
    }

    public function countAdminUserSummaries(UserSearchData $searchData): int
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.roles NOT LIKE :adminRole')
            ->setParameter('adminRole', '%ROLE_ADMIN%');

        $term = trim((string) $searchData->term);
        if ($term !== '') {
            $queryBuilder
                ->andWhere('LOWER(u.firstName) LIKE :term OR LOWER(u.lastName) LIKE :term OR LOWER(u.email) LIKE :term')
                ->setParameter('term', '%'.mb_strtolower($term).'%');
        }

        match ($searchData->status) {
            UserSearchData::STATUS_ACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', true),
            UserSearchData::STATUS_INACTIVE => $queryBuilder
                ->andWhere('u.isActive = :isActive')
                ->setParameter('isActive', false),
            UserSearchData::STATUS_VERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', true),
            UserSearchData::STATUS_UNVERIFIED => $queryBuilder
                ->andWhere('u.isVerified = :isVerified')
                ->setParameter('isVerified', false),
            UserSearchData::STATUS_VETERAN_PENDING => $queryBuilder
                ->andWhere('u.isVeteranApplicant = :isVeteranApplicant')
                ->andWhere('u.isVeteranApproved = :isVeteranApproved')
                ->setParameter('isVeteranApplicant', true)
                ->setParameter('isVeteranApproved', false),
            default => null,
        };

        return (int) $queryBuilder->getQuery()->getSingleScalarResult();
    }

    /**
     * @return list<User>
     */
    public function searchSocialCandidates(User $currentUser, string $term, int $limit = 8): array
    {
        $normalizedTerm = mb_strtolower(trim($term));

        if ($normalizedTerm === '') {
            return [];
        }

        return $this->createQueryBuilder('u')
            ->andWhere('u.id != :currentUserId')
            ->andWhere('u.isActive = :isActive')
            ->andWhere('LOWER(u.firstName) LIKE :term OR LOWER(u.lastName) LIKE :term OR LOWER(u.email) LIKE :term')
            ->setParameter('currentUserId', $currentUser->getId())
            ->setParameter('isActive', true)
            ->setParameter('term', '%'.$normalizedTerm.'%')
            ->orderBy('u.firstName', 'ASC')
            ->addOrderBy('u.lastName', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param list<int> $ids
     *
     * @return array<int, User>
     */
    public function findIndexedByIds(array $ids): array
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids))));
        if ($ids === []) {
            return [];
        }

        $users = $this->createQueryBuilder('u')
            ->andWhere('u.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $indexedUsers = [];
        foreach ($users as $user) {
            if (!$user instanceof User || $user->getId() === null) {
                continue;
            }

            $indexedUsers[$user->getId()] = $user;
        }

        return $indexedUsers;
    }

    public function findOneByRecoveryIdentifier(string $identifier): ?User
    {
        $normalizedIdentifier = trim($identifier);
        if ($normalizedIdentifier === '') {
            return null;
        }

        if (filter_var($normalizedIdentifier, FILTER_VALIDATE_EMAIL)) {
            return $this->findOneBy(['email' => mb_strtolower($normalizedIdentifier)]);
        }

        $normalizedPhone = $this->normalizePhoneNumber($normalizedIdentifier);
        if ($normalizedPhone === null) {
            return null;
        }

        /** @var list<User> $users */
        $users = $this->createQueryBuilder('u')
            ->andWhere('u.phoneNumber IS NOT NULL')
            ->getQuery()
            ->getResult();

        foreach ($users as $user) {
            if ($this->normalizePhoneNumber((string) $user->getPhoneNumber()) === $normalizedPhone) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @return list<User>
     */
    public function findActiveEmailRecipients(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.isActive = :active')
            ->andWhere('u.email IS NOT NULL')
            ->setParameter('active', true)
            ->orderBy('u.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findDefaultUser(): ?User
    {
        $user = $this->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $user instanceof User ? $user : null;
    }

    private function normalizePhoneNumber(string $value): ?string
    {
        $normalized = preg_replace('/\D+/', '', $value);
        if ($normalized === null || strlen($normalized) < 7) {
            return null;
        }

        return $normalized;
    }
}
