<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260322110000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add account activation and veteran approval workflow fields to user records.';
    }

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('user')) {
            return;
        }

        $table = $schema->getTable('user');

        if (!$table->hasColumn('is_active')) {
            $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL DEFAULT 1');
        }

        if (!$table->hasColumn('is_veteran_applicant')) {
            $this->addSql('ALTER TABLE user ADD is_veteran_applicant TINYINT(1) NOT NULL DEFAULT 0');
        }

        if (!$table->hasColumn('is_veteran_approved')) {
            $this->addSql('ALTER TABLE user ADD is_veteran_approved TINYINT(1) NOT NULL DEFAULT 0');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP is_active, DROP is_veteran_applicant, DROP is_veteran_approved');
    }
}
