<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260405094900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add manager_id and capacity to hotel';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE hotel ADD manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD capacity INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE hotel DROP manager_id');
        $this->addSql('ALTER TABLE hotel DROP capacity');
    }
}