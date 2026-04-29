<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260419121500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Repair reservation primary key and indexes after schema imports that drop identity metadata.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['reservation'])) {
            return;
        }

        $indexes = array_change_key_case($schemaManager->listTableIndexes('reservation'), CASE_LOWER);

        if (isset($indexes['primary'])) {
            $this->addSql('ALTER TABLE reservation MODIFY id INT NOT NULL AUTO_INCREMENT');
        } else {
            $this->addSql('ALTER TABLE reservation MODIFY id INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)');
        }

        $this->addMissingIndex($indexes, 'fk_reservation_client', 'client_id');
        $this->addMissingIndex($indexes, 'fk_reservation_animal', 'animal_id');
        $this->addMissingIndex($indexes, 'fk_reservation_hotel', 'hotel_id');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['reservation'])) {
            return;
        }

        $indexes = array_change_key_case($schemaManager->listTableIndexes('reservation'), CASE_LOWER);

        foreach (['fk_reservation_client', 'fk_reservation_animal', 'fk_reservation_hotel'] as $indexName) {
            if (isset($indexes[strtolower($indexName)])) {
                $this->addSql(sprintf('DROP INDEX %s ON reservation', $indexName));
            }
        }

        if (isset($indexes['primary'])) {
            $this->addSql('ALTER TABLE reservation DROP PRIMARY KEY, MODIFY id INT NOT NULL');
        }
    }

    /**
     * @param array<string, mixed> $indexes
     */
    private function addMissingIndex(array $indexes, string $indexName, string $columnName): void
    {
        if (!isset($indexes[strtolower($indexName)])) {
            $this->addSql(sprintf('CREATE INDEX %s ON reservation (%s)', $indexName, $columnName));
        }
    }
}
