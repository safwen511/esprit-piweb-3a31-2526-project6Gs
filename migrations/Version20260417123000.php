<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260417123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert shop promo codes from per-user codes to shared codes with usage counters.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $this->skipIf(!$schemaManager->tablesExist(['promo_code']), 'The promo_code table does not exist.');

        $columns = array_change_key_case($schemaManager->listTableColumns('promo_code'), CASE_LOWER);

        if (isset($columns['user_id'])) {
            $this->addSql('ALTER TABLE promo_code MODIFY user_id INT DEFAULT NULL');
        }

        if (!isset($columns['max_uses'])) {
            $this->addSql('ALTER TABLE promo_code ADD max_uses INT DEFAULT NULL');
        }

        if (!isset($columns['used_count'])) {
            $this->addSql('ALTER TABLE promo_code ADD used_count INT NOT NULL DEFAULT 0');
        }

        $this->addSql('UPDATE promo_code SET used_count = CASE WHEN used_at IS NULL THEN 0 ELSE 1 END WHERE used_count = 0');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $this->skipIf(!$schemaManager->tablesExist(['promo_code']), 'The promo_code table does not exist.');

        $columns = array_change_key_case($schemaManager->listTableColumns('promo_code'), CASE_LOWER);

        if (isset($columns['used_count'])) {
            $this->addSql('ALTER TABLE promo_code DROP COLUMN used_count');
        }

        if (isset($columns['max_uses'])) {
            $this->addSql('ALTER TABLE promo_code DROP COLUMN max_uses');
        }

        if (isset($columns['user_id'])) {
            $this->addSql('ALTER TABLE promo_code MODIFY user_id INT NOT NULL');
        }
    }
}
