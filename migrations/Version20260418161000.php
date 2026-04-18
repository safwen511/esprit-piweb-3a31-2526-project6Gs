<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418161000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove obsolete passkey_credential table after switching to camera-based face recognition.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (!$schemaManager->tablesExist(['passkey_credential'])) {
            return;
        }

        $this->addSql('DROP TABLE passkey_credential');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if ($schemaManager->tablesExist(['passkey_credential'])) {
            return;
        }

        $this->addSql("CREATE TABLE passkey_credential (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, credential_id VARCHAR(255) NOT NULL, label VARCHAR(120) NOT NULL, source_data LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', last_used_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_4951F09A4F7E7007 (credential_id), INDEX IDX_4951F09AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql('ALTER TABLE passkey_credential ADD CONSTRAINT FK_4951F09AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
