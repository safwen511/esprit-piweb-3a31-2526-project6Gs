<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418173000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add voice recognition fields to user table.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $columns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('user'));

        if (!in_array('voice_sample_path', $columns, true)) {
            $this->addSql('ALTER TABLE user ADD voice_sample_path VARCHAR(255) DEFAULT NULL');
        }

        if (!in_array('voice_vector', $columns, true)) {
            $this->addSql('ALTER TABLE user ADD voice_vector JSON DEFAULT NULL');
        }

        if (!in_array('voice_enrolled_at', $columns, true)) {
            $this->addSql("ALTER TABLE user ADD voice_enrolled_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'");
        }

        if (!in_array('voice_last_used_at', $columns, true)) {
            $this->addSql("ALTER TABLE user ADD voice_last_used_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'");
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $columns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('user'));

        if (in_array('voice_last_used_at', $columns, true)) {
            $this->addSql('ALTER TABLE user DROP voice_last_used_at');
        }

        if (in_array('voice_enrolled_at', $columns, true)) {
            $this->addSql('ALTER TABLE user DROP voice_enrolled_at');
        }

        if (in_array('voice_vector', $columns, true)) {
            $this->addSql('ALTER TABLE user DROP voice_vector');
        }

        if (in_array('voice_sample_path', $columns, true)) {
            $this->addSql('ALTER TABLE user DROP voice_sample_path');
        }
    }
}
