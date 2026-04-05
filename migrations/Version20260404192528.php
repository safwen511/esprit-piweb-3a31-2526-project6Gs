<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260404192528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, client_name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, hotel_id INT NOT NULL, FOREIGN KEY (hotel_id) REFERENCES hotel (id))');
        $this->addSql('CREATE INDEX IDX_42C849553243BB18 ON reservation (hotel_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
