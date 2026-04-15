<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260415171252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD signature LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vet_planning_event DROP FOREIGN KEY FK_4C0DA43A40369CAB');
        $this->addSql('DROP INDEX idx_4c0da43a40369cab ON vet_planning_event');
        $this->addSql('CREATE INDEX IDX_8DBB4DCC40369CAB ON vet_planning_event (vet_id)');
        $this->addSql('ALTER TABLE vet_planning_event ADD CONSTRAINT FK_4C0DA43A40369CAB FOREIGN KEY (vet_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP signature');
        $this->addSql('ALTER TABLE vet_planning_event DROP FOREIGN KEY FK_8DBB4DCC40369CAB');
        $this->addSql('DROP INDEX idx_8dbb4dcc40369cab ON vet_planning_event');
        $this->addSql('CREATE INDEX IDX_4C0DA43A40369CAB ON vet_planning_event (vet_id)');
        $this->addSql('ALTER TABLE vet_planning_event ADD CONSTRAINT FK_8DBB4DCC40369CAB FOREIGN KEY (vet_id) REFERENCES user (id)');
    }
}
