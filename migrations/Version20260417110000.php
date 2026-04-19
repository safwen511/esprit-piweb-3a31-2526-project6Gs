<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260417110000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add promo_code table for per-user shop discount codes.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $this->skipIf($schemaManager->tablesExist(['promo_code']), 'The promo_code table already exists.');

        $this->addSql('CREATE TABLE promo_code (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT DEFAULT NULL, code VARCHAR(40) NOT NULL, discount_percentage DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', used_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX uniq_promo_code_code (code), INDEX IDX_3A11F3BBA76ED395 (user_id), INDEX IDX_3A11F3BB4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3A11F3BBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3A11F3BB4584665A FOREIGN KEY (product_id) REFERENCES produit (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $this->skipIf(!$schemaManager->tablesExist(['promo_code']), 'The promo_code table does not exist.');

        $this->addSql('ALTER TABLE promo_code DROP FOREIGN KEY FK_3A11F3BBA76ED395');
        $this->addSql('ALTER TABLE promo_code DROP FOREIGN KEY FK_3A11F3BB4584665A');
        $this->addSql('DROP TABLE promo_code');
    }
}
