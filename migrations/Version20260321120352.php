<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260321120352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the FurHope user table or upgrade an existing legacy user table to the base schema.';
    }

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('user')) {
            $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(120) NOT NULL, last_name VARCHAR(120) NOT NULL, phone_number VARCHAR(30) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

            return;
        }

        $table = $schema->getTable('user');

        if ($table->hasColumn('first_name')) {
            $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(120) NOT NULL');
        }

        if ($table->hasColumn('last_name')) {
            $this->addSql('ALTER TABLE user CHANGE last_name last_name VARCHAR(120) NOT NULL');
        }

        if ($table->hasColumn('email')) {
            $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL');
        }

        if ($table->hasColumn('phone') && !$table->hasColumn('phone_number')) {
            $this->addSql('ALTER TABLE user CHANGE phone phone_number VARCHAR(30) DEFAULT NULL');
        } elseif (!$table->hasColumn('phone_number')) {
            $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(30) DEFAULT NULL');
        }

        if (!$table->hasColumn('roles')) {
            $this->addSql('ALTER TABLE user ADD roles JSON DEFAULT NULL');

            if ($table->hasColumn('role')) {
                $this->addSql(<<<'SQL'
UPDATE user
SET roles = CASE LOWER(role)
    WHEN 'admin' THEN JSON_ARRAY('ROLE_ADMIN')
    WHEN 'role_admin' THEN JSON_ARRAY('ROLE_ADMIN')
    WHEN 'veterinaire' THEN JSON_ARRAY('ROLE_VETERINAIRE')
    WHEN 'role_veterinaire' THEN JSON_ARRAY('ROLE_VETERINAIRE')
    ELSE JSON_ARRAY('ROLE_USER')
END
SQL);
            } else {
                $this->addSql("UPDATE user SET roles = JSON_ARRAY('ROLE_USER') WHERE roles IS NULL");
            }

            $this->addSql('ALTER TABLE user MODIFY roles JSON NOT NULL');
        }

        if ($table->hasColumn('active') && !$table->hasColumn('is_active')) {
            $this->addSql('ALTER TABLE user CHANGE active is_active TINYINT(1) NOT NULL DEFAULT 1');
        } elseif (!$table->hasColumn('is_active')) {
            $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL DEFAULT 1');
        }

        if (!$table->hasColumn('is_verified')) {
            $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL DEFAULT 1');
        }

        if ($table->hasColumn('created_at')) {
            $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        } else {
            $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        }

        if (!$table->hasColumn('updated_at')) {
            $this->addSql('ALTER TABLE user ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
            $this->addSql('UPDATE user SET updated_at = COALESCE(created_at, NOW()) WHERE updated_at IS NULL');
            $this->addSql('ALTER TABLE user MODIFY updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        } else {
            $this->addSql('ALTER TABLE user CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        }

        if (!$table->hasColumn('is_veteran_applicant')) {
            $this->addSql('ALTER TABLE user ADD is_veteran_applicant TINYINT(1) NOT NULL DEFAULT 0');
        }

        if (!$table->hasColumn('is_veteran_approved')) {
            $this->addSql('ALTER TABLE user ADD is_veteran_approved TINYINT(1) NOT NULL DEFAULT 0');
        }

        if ($table->hasColumn('profile_image_path') && !$table->hasColumn('profile_image_url')) {
            $this->addSql('ALTER TABLE user CHANGE profile_image_path profile_image_url VARCHAR(255) DEFAULT NULL');
        } elseif (!$table->hasColumn('profile_image_url')) {
            $this->addSql('ALTER TABLE user ADD profile_image_url VARCHAR(255) DEFAULT NULL');
        }

        if (!$table->hasIndex('UNIQ_8D93D649E7927C74')) {
            $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
