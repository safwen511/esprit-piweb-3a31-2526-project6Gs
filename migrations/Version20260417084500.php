<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260417084500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ensure animal.idAnimal is a primary key with AUTO_INCREMENT for Doctrine identity generation.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['animal'])) {
            return;
        }

        $indexes = $schemaManager->listTableIndexes('animal');
        if (isset($indexes['primary'])) {
            $this->addSql('ALTER TABLE animal MODIFY idAnimal INT NOT NULL AUTO_INCREMENT');

            return;
        }

        $this->addSql('ALTER TABLE animal MODIFY idAnimal INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (idAnimal)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE animal DROP PRIMARY KEY, MODIFY idAnimal INT NOT NULL');
    }
}
