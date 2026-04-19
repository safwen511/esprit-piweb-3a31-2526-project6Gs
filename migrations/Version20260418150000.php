<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418150000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add face_credential table for camera-based face recognition login.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if ($schemaManager->tablesExist(['face_credential'])) {
            return;
        }

        $this->addSql('CREATE TABLE face_credential (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, descriptor JSON NOT NULL, label VARCHAR(120) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_used_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FACE_USER (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE face_credential ADD CONSTRAINT FK_FACE_USER FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (!$schemaManager->tablesExist(['face_credential'])) {
            return;
        }

        $this->addSql('DROP TABLE face_credential');
    }
}
