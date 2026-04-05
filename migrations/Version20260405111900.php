<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260405111900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add price_per_night to hotel table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE hotel ADD COLUMN price_per_night VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE hotel DROP COLUMN price_per_night');
    }
}
