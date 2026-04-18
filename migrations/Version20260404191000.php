<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260404191000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add shop product and cart tables without replacing the shared user model.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if ($schemaManager->tablesExist(['user'])) {
            $columns = [];
            foreach ($schemaManager->listTableColumns('user') as $column) {
                $columns[strtolower($column->getName())] = true;
            }

            if (!isset($columns['roles'])) {
                $this->addSql('ALTER TABLE user ADD roles JSON DEFAULT NULL');
            }

            if (!isset($columns['phone_number'])) {
                $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(30) DEFAULT NULL');
            }

            if (!isset($columns['profile_image_url'])) {
                $this->addSql('ALTER TABLE user ADD profile_image_url VARCHAR(255) DEFAULT NULL');
            }

            if (!isset($columns['is_verified'])) {
                $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL DEFAULT 1');
            }

            if (!isset($columns['is_active'])) {
                $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL DEFAULT 1');
            }

            if (!isset($columns['is_veteran_applicant'])) {
                $this->addSql('ALTER TABLE user ADD is_veteran_applicant TINYINT(1) NOT NULL DEFAULT 0');
            }

            if (!isset($columns['is_veteran_approved'])) {
                $this->addSql('ALTER TABLE user ADD is_veteran_approved TINYINT(1) NOT NULL DEFAULT 0');
            }

            if (!isset($columns['updated_at'])) {
                $this->addSql('ALTER TABLE user ADD updated_at DATETIME DEFAULT NULL');
            }

            $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(120) NOT NULL, CHANGE last_name last_name VARCHAR(120) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');

            if (isset($columns['phone'])) {
                $this->addSql('UPDATE user SET phone_number = COALESCE(phone_number, NULLIF(phone, \'\'))');
            }

            if (isset($columns['profile_image_path'])) {
                $this->addSql('UPDATE user SET profile_image_url = COALESCE(profile_image_url, NULLIF(profile_image_path, \'\'))');
            }

            if (isset($columns['active'])) {
                $this->addSql('UPDATE user SET is_active = COALESCE(active, is_active, 1)');
            }

            $this->addSql('UPDATE user SET updated_at = COALESCE(updated_at, created_at, NOW())');

            if (isset($columns['role'])) {
                $this->addSql('UPDATE user SET roles = CASE WHEN UPPER(COALESCE(role, \'\')) = \'ADMIN\' THEN JSON_ARRAY(\'ROLE_ADMIN\', \'ROLE_USER\') ELSE JSON_ARRAY(\'ROLE_USER\') END WHERE roles IS NULL');
            } else {
                $this->addSql('UPDATE user SET roles = JSON_ARRAY(\'ROLE_USER\') WHERE roles IS NULL');
            }

            $this->addSql('ALTER TABLE user MODIFY roles JSON NOT NULL');
            $this->addSql('ALTER TABLE user MODIFY updated_at DATETIME NOT NULL');
        }

        if (!$schemaManager->tablesExist(['produit'])) {
            $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, category VARCHAR(50) NOT NULL DEFAULT \'medical\', price DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        } else {
            $columns = [];
            foreach ($schemaManager->listTableColumns('produit') as $column) {
                $columns[strtolower($column->getName())] = true;
            }

            if (!isset($columns['category'])) {
                $this->addSql('ALTER TABLE produit ADD category VARCHAR(50) NOT NULL DEFAULT \'medical\'');
            }
        }

        if (!$schemaManager->tablesExist(['panier'])) {
            $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, idProduit INT NOT NULL, client_id INT NOT NULL, title VARCHAR(255) NOT NULL, totalP DOUBLE PRECISION NOT NULL, totalt DOUBLE PRECISION NOT NULL, qty INT NOT NULL, INDEX idx_panier_produit (idProduit), INDEX idx_panier_client (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        } else {
            $columns = [];
            foreach ($schemaManager->listTableColumns('panier') as $column) {
                $columns[strtolower($column->getName())] = true;
            }

            if (!isset($columns['client_id'])) {
                $this->addSql('ALTER TABLE panier ADD client_id INT NOT NULL');
                $this->addSql('CREATE INDEX idx_panier_client ON panier (client_id)');
            }
        }

        $foreignKeys = [];
        if ($schemaManager->tablesExist(['panier'])) {
            foreach ($schemaManager->listTableForeignKeys('panier') as $foreignKey) {
                $foreignKeys[strtolower($foreignKey->getLocalColumns()[0] ?? $foreignKey->getName())] = true;
            }
        }

        if (!isset($foreignKeys['idproduit'])) {
            $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_PANIER_PRODUIT FOREIGN KEY (idProduit) REFERENCES produit (id) ON DELETE CASCADE');
        }

        if (!isset($foreignKeys['client_id'])) {
            $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_PANIER_CLIENT FOREIGN KEY (client_id) REFERENCES user (id) ON DELETE CASCADE');
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if ($schemaManager->tablesExist(['user'])) {
            $columns = [];
            foreach ($schemaManager->listTableColumns('user') as $column) {
                $columns[strtolower($column->getName())] = true;
            }

            $drops = [];
            foreach (['roles', 'phone_number', 'profile_image_url', 'is_verified', 'is_active', 'is_veteran_applicant', 'is_veteran_approved', 'updated_at'] as $columnName) {
                if (isset($columns[$columnName])) {
                    $drops[] = sprintf('DROP COLUMN %s', $columnName);
                }
            }

            if ($drops !== []) {
                $this->addSql('ALTER TABLE user '.implode(', ', $drops));
            }
        }

        if ($schemaManager->tablesExist(['panier'])) {
            foreach ($schemaManager->listTableForeignKeys('panier') as $foreignKey) {
                $localColumns = array_map('strtolower', $foreignKey->getLocalColumns());
                if (in_array('idproduit', $localColumns, true) || in_array('client_id', $localColumns, true)) {
                    $this->addSql(sprintf('ALTER TABLE panier DROP FOREIGN KEY %s', $foreignKey->getName()));
                }
            }
        }

        $this->addSql('DROP TABLE IF EXISTS panier');
        $this->addSql('DROP TABLE IF EXISTS produit');
    }
}
