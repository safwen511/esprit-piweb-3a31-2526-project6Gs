<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260415011818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['review'])) {
            $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, vet_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_794381C640369CAB (vet_id), INDEX IDX_794381C619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        }

        $foreignKeys = [];
        foreach ($schemaManager->listTableForeignKeys('review') as $foreignKey) {
            $foreignKeys[$foreignKey->getName()] = true;
        }

        if (!isset($foreignKeys['FK_794381C640369CAB'])) {
            $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C640369CAB FOREIGN KEY (vet_id) REFERENCES user (id)');
        }

        if (!isset($foreignKeys['FK_794381C619EB6921'])) {
            $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C640369CAB');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C619EB6921');
        $this->addSql('DROP TABLE review');
    }
}
