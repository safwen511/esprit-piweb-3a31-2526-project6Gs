<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260412100000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create reset password request table.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['user'])) {
            return;
        }

        if ($schemaManager->tablesExist(['reset_password_request'])) {
            return;
        }

        $this->addSql("CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', expires_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_7CE748AA76ED395 (user_id), UNIQUE INDEX UNIQ_7CE748AA2C0E4E2 (selector), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['reset_password_request'])) {
            return;
        }

        foreach ($schemaManager->listTableForeignKeys('reset_password_request') as $foreignKey) {
            $this->addSql(sprintf('ALTER TABLE reset_password_request DROP FOREIGN KEY %s', $foreignKey->getName()));
        }

        $this->addSql('DROP TABLE reset_password_request');
    }
}
