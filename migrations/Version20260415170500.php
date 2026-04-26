<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260415170500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create vet planning event table';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['vet_planning_event'])) {
            $this->addSql('CREATE TABLE vet_planning_event (id INT AUTO_INCREMENT NOT NULL, vet_id INT NOT NULL, title VARCHAR(120) NOT NULL, event_type VARCHAR(30) NOT NULL, starts_at DATETIME NOT NULL, ends_at DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_4C0DA43A40369CAB (vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        $foreignKeys = [];
        foreach ($schemaManager->listTableForeignKeys('vet_planning_event') as $foreignKey) {
            $foreignKeys[$foreignKey->getName()] = true;
        }

        if (!isset($foreignKeys['FK_4C0DA43A40369CAB'])) {
            $this->addSql('ALTER TABLE vet_planning_event ADD CONSTRAINT FK_4C0DA43A40369CAB FOREIGN KEY (vet_id) REFERENCES user (id)');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE vet_planning_event DROP FOREIGN KEY FK_4C0DA43A40369CAB');
        $this->addSql('DROP TABLE vet_planning_event');
    }
}
