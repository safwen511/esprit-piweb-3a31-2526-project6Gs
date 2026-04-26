<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418200000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix reset_password_request primary key auto increment.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();

        if (!in_array('reset_password_request', $tables, true)) {
            return;
        }

        $columns = $schemaManager->listTableColumns('reset_password_request');
        if (!isset($columns['id'])) {
            return;
        }

        $idColumn = $columns['id'];
        $primaryKey = $schemaManager->introspectTable('reset_password_request')->getPrimaryKey();
        $primaryColumns = $primaryKey?->getColumns() ?? [];

        if ($idColumn->getAutoincrement() && $primaryColumns === ['id']) {
            return;
        }

        if ($primaryColumns !== ['id']) {
            $this->addSql('ALTER TABLE reset_password_request ADD PRIMARY KEY (id)');
        }

        if (!$idColumn->getAutoincrement()) {
            $this->addSql('ALTER TABLE reset_password_request MODIFY id INT NOT NULL AUTO_INCREMENT');
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();

        if (!in_array('reset_password_request', $tables, true)) {
            return;
        }

        $this->addSql('ALTER TABLE reset_password_request DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE reset_password_request MODIFY id INT NOT NULL');
    }
}
