<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418184500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add saved voice passphrase to user table.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $columns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('user'));

        if (!in_array('voice_passphrase', $columns, true)) {
            $this->addSql('ALTER TABLE user ADD voice_passphrase VARCHAR(255) DEFAULT NULL');
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $columns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('user'));

        if (in_array('voice_passphrase', $columns, true)) {
            $this->addSql('ALTER TABLE user DROP voice_passphrase');
        }
    }
}
