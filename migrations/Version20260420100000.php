<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260420100000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Repair rendezvous primary key and indexes after schema imports that drop identity metadata.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['rendezvous'])) {
            return;
        }

        $indexes = array_change_key_case($schemaManager->listTableIndexes('rendezvous'), CASE_LOWER);

        if (isset($indexes['primary'])) {
            $this->addSql('ALTER TABLE rendezvous MODIFY id_rdv INT NOT NULL AUTO_INCREMENT');
        } else {
            $this->addSql('ALTER TABLE rendezvous MODIFY id_rdv INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id_rdv)');
        }

        $this->addMissingIndex($indexes, 'idx_rendezvous_client', 'client_id');
        $this->addMissingIndex($indexes, 'idx_rendezvous_vet', 'vet_id');
        $this->addMissingIndex($indexes, 'idx_rendezvous_animal', 'animal_id');
        $this->addMissingIndex($indexes, 'idx_rendezvous_disponibilite', 'disponibilite_id');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['rendezvous'])) {
            return;
        }

        $indexes = array_change_key_case($schemaManager->listTableIndexes('rendezvous'), CASE_LOWER);

        foreach ([
            'idx_rendezvous_client',
            'idx_rendezvous_vet',
            'idx_rendezvous_animal',
            'idx_rendezvous_disponibilite',
        ] as $indexName) {
            if (isset($indexes[strtolower($indexName)])) {
                $this->addSql(sprintf('DROP INDEX %s ON rendezvous', $indexName));
            }
        }

        if (isset($indexes['primary'])) {
            $this->addSql('ALTER TABLE rendezvous DROP PRIMARY KEY, MODIFY id_rdv INT NOT NULL');
        }
    }

    /**
     * @param array<string, mixed> $indexes
     */
    private function addMissingIndex(array $indexes, string $indexName, string $columnName): void
    {
        if (!isset($indexes[strtolower($indexName)])) {
            $this->addSql(sprintf('CREATE INDEX %s ON rendezvous (%s)', $indexName, $columnName));
        }
    }
}
