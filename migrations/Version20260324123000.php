<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260324123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add an optional profile image URL to user records.';
    }

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('user')) {
            return;
        }

        $table = $schema->getTable('user');

        if ($table->hasColumn('profile_image_path') && !$table->hasColumn('profile_image_url')) {
            $this->addSql('ALTER TABLE user CHANGE profile_image_path profile_image_url VARCHAR(255) DEFAULT NULL');

            return;
        }

        if (!$table->hasColumn('profile_image_url')) {
            $this->addSql('ALTER TABLE user ADD profile_image_url VARCHAR(255) DEFAULT NULL');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP profile_image_url');
    }
}
