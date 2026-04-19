<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260419113000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add hotel coordinates and reservation QR code storage.';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();

        if (in_array('hotel', $tables, true)) {
            $hotelColumns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('hotel'));

            if (!in_array('latitude', $hotelColumns, true)) {
                $this->addSql('ALTER TABLE hotel ADD latitude DOUBLE PRECISION DEFAULT NULL');
            }

            if (!in_array('longitude', $hotelColumns, true)) {
                $this->addSql('ALTER TABLE hotel ADD longitude DOUBLE PRECISION DEFAULT NULL');
            }
        }

        if (in_array('reservation', $tables, true)) {
            $reservationColumns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('reservation'));

            if (!in_array('qr_code_path', $reservationColumns, true)) {
                $this->addSql('ALTER TABLE reservation ADD qr_code_path VARCHAR(255) DEFAULT NULL');
            }

            if (!in_array('qr_code_generated_at', $reservationColumns, true)) {
                $this->addSql("ALTER TABLE reservation ADD qr_code_generated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'");
            }
        }
    }

    public function down(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();

        if (in_array('hotel', $tables, true)) {
            $hotelColumns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('hotel'));

            if (in_array('latitude', $hotelColumns, true)) {
                $this->addSql('ALTER TABLE hotel DROP latitude');
            }

            if (in_array('longitude', $hotelColumns, true)) {
                $this->addSql('ALTER TABLE hotel DROP longitude');
            }
        }

        if (in_array('reservation', $tables, true)) {
            $reservationColumns = array_map(static fn ($column) => $column->getName(), $schemaManager->listTableColumns('reservation'));

            if (in_array('qr_code_generated_at', $reservationColumns, true)) {
                $this->addSql('ALTER TABLE reservation DROP qr_code_generated_at');
            }

            if (in_array('qr_code_path', $reservationColumns, true)) {
                $this->addSql('ALTER TABLE reservation DROP qr_code_path');
            }
        }
    }
}
