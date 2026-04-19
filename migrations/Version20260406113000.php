<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260406113000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Link shop products to the user who created them.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['produit', 'user'])) {
            return;
        }

        $columns = [];
        foreach ($schemaManager->listTableColumns('produit') as $column) {
            $columns[strtolower($column->getName())] = true;
        }

        if (!isset($columns['owner_id'])) {
            $this->addSql('ALTER TABLE produit ADD owner_id INT DEFAULT NULL');
            $this->addSql('CREATE INDEX IDX_29A5EC27E3C61F9 ON produit (owner_id)');
        }

        $hasOwnerForeignKey = false;
        foreach ($schemaManager->listTableForeignKeys('produit') as $foreignKey) {
            $localColumns = array_map('strtolower', $foreignKey->getLocalColumns());
            if (in_array('owner_id', $localColumns, true)) {
                $hasOwnerForeignKey = true;
                break;
            }
        }

        if (!$hasOwnerForeignKey) {
            $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) ON DELETE SET NULL');
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['produit'])) {
            return;
        }

        foreach ($schemaManager->listTableForeignKeys('produit') as $foreignKey) {
            $localColumns = array_map('strtolower', $foreignKey->getLocalColumns());
            if (in_array('owner_id', $localColumns, true)) {
                $this->addSql(sprintf('ALTER TABLE produit DROP FOREIGN KEY %s', $foreignKey->getName()));
            }
        }

        $columns = [];
        foreach ($schemaManager->listTableColumns('produit') as $column) {
            $columns[strtolower($column->getName())] = true;
        }

        if (isset($columns['owner_id'])) {
            $this->addSql('DROP INDEX IDX_29A5EC27E3C61F9 ON produit');
            $this->addSql('ALTER TABLE produit DROP owner_id');
        }
    }
}
