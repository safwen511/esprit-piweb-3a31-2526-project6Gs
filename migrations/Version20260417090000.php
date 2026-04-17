<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260417090000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing adoption_request foreign key and index to animal.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX IDX_410896EE8E962C16 ON adoption_request (animal_id)');
        $this->addSql('ALTER TABLE adoption_request ADD CONSTRAINT FK_410896EE8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (idAnimal)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE adoption_request DROP FOREIGN KEY FK_410896EE8E962C16');
        $this->addSql('DROP INDEX IDX_410896EE8E962C16 ON adoption_request');
    }
}
