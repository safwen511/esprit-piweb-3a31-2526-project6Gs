<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260405085328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE adoption_request DROP FOREIGN KEY `adoption_request_ibfk_1`');
        $this->addSql('ALTER TABLE adoption_request DROP FOREIGN KEY `fk_adoption_client`');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY `comment_ibfk_1`');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY `comment_ibfk_2`');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY `comment_ibfk_3`');
        $this->addSql('ALTER TABLE comment_reaction DROP FOREIGN KEY `fk_comment_reaction_comment`');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY `compte_ibfk_1`');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY `disponibilite_ibfk_1`');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY `fk_panier_client`');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY `panier_ibfk_1`');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY `post_ibfk_1`');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY `fk_reclamation_client`');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY `rendezvous_ibfk_1`');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY `rendezvous_ibfk_2`');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY `rendezvous_ibfk_3`');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY `rendezvous_ibfk_4`');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY `fk_reponse_admin`');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY `fk_reponse_reclamation`');
        $this->addSql('DROP TABLE adoptionrequest');
        $this->addSql('DROP TABLE adoption_request');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE client_gestion');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE comment_reaction');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('DROP TABLE friend_request');
        $this->addSql('DROP TABLE manager_account');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_reaction');
        $this->addSql('DROP TABLE post_report');
        $this->addSql('DROP TABLE post_share');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE promo_codes');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE rendezvous');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY `fk_hotel_manager`');
        $this->addSql('DROP INDEX fk_hotel_manager ON hotel');
        $this->addSql('ALTER TABLE hotel DROP created_at, CHANGE name name VARCHAR(255) NOT NULL, CHANGE capacity capacity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY `fk_reservation_animal`');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY `fk_reservation_client`');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY `fk_reservation_hotel`');
        $this->addSql('DROP INDEX fk_reservation_client ON reservation');
        $this->addSql('DROP INDEX fk_reservation_animal ON reservation');
        $this->addSql('ALTER TABLE reservation ADD client_name VARCHAR(255) NOT NULL, ADD date DATETIME NOT NULL, DROP client_id, DROP animal_id, DROP start_date, DROP end_date, DROP status, DROP created_at, DROP reservation_date, DROP guest_count, DROP nightly_rate, DROP total_price, CHANGE hotel_id hotel_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE reservation RENAME INDEX fk_reservation_hotel TO IDX_42C849553243BB18');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoptionrequest (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, client_compte_id INT NOT NULL, message TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'PENDING\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE adoption_request (id INT AUTO_INCREMENT NOT NULL, request_date DATETIME DEFAULT \'current_timestamp()\' NOT NULL, status ENUM(\'PENDING\', \'APPROVED\', \'REJECTED\') CHARACTER SET utf8mb4 DEFAULT \'\'\'PENDING\'\'\' COLLATE `utf8mb4_general_ci`, animal_id INT NOT NULL, client_id INT NOT NULL, INDEX fk_adoption_client (client_id), INDEX animal_id (animal_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE animal (idAnimal INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, species VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, breed VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, age INT DEFAULT NULL, gender ENUM(\'MALE\', \'FEMALE\') CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, status ENUM(\'AVAILABLE\', \'ADOPTED\', \'UNAVAILABLE\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, owner_compte_id INT DEFAULT NULL, PRIMARY KEY (idAnimal)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client_gestion (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, city VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, status VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'\'\'ACTIVE\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comment (id BIGINT AUTO_INCREMENT NOT NULL, post_id BIGINT NOT NULL, author_id INT NOT NULL, parent_comment_id BIGINT DEFAULT NULL, body TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status ENUM(\'ACTIVE\', \'HIDDEN\', \'DELETED\') CHARACTER SET utf8mb4 DEFAULT \'\'\'ACTIVE\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX idx_comment_post (post_id), INDEX author_id (author_id), INDEX parent_comment_id (parent_comment_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comment_reaction (comment_id BIGINT NOT NULL, user_id BIGINT NOT NULL, reaction VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX IDX_B99364F1F8697D13 (comment_id), PRIMARY KEY (comment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE compte (id_compte INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, username VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role ENUM(\'CLIENT\', \'ADMIN\', \'MANAGER\', \'VET\', \'HOTEL\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status ENUM(\'ACTIVE\', \'INACTIVE\') CHARACTER SET utf8mb4 DEFAULT \'\'\'ACTIVE\'\'\' COLLATE `utf8mb4_general_ci`, UNIQUE INDEX username (username), INDEX user_id (user_id), PRIMARY KEY (id_compte)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE disponibilite (id_disponibilite INT AUTO_INCREMENT NOT NULL, vet_id INT NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, is_available TINYINT DEFAULT 1, INDEX vet_id (vet_id), PRIMARY KEY (id_disponibilite)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE friendship (id BIGINT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX fk_fs_u2 (user2_id), UNIQUE INDEX uq_friendship_pair (user1_id, user2_id), UNIQUE INDEX uq_friendship (user1_id, user2_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE friend_request (id BIGINT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, status ENUM(\'PENDING\', \'ACCEPTED\', \'DECLINED\', \'CANCELLED\') CHARACTER SET utf8mb4 DEFAULT \'\'\'PENDING\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX fk_fr_receiver (receiver_id), UNIQUE INDEX uq_request (sender_id, receiver_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE manager_account (id BIGINT AUTO_INCREMENT NOT NULL, manager_id VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, display_name VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password_hash VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password_salt VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password_iterations INT NOT NULL, is_active TINYINT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, UNIQUE INDEX manager_id (manager_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notification (id BIGINT AUTO_INCREMENT NOT NULL, recipient_id INT NOT NULL, actor_id INT NOT NULL, type ENUM(\'POST_LIKE\', \'POST_DISLIKE\', \'POST_COMMENT\', \'COMMENT_REPLY\', \'COMMENT_LIKE\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, post_id BIGINT DEFAULT NULL, comment_id BIGINT DEFAULT NULL, message VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, is_read TINYINT DEFAULT 0 NOT NULL, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX fk_notif_actor (actor_id), INDEX idx_recipient_read_time (recipient_id, is_read, created_at), INDEX fk_notif_post (post_id), INDEX fk_notif_comment (comment_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders (id BIGINT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, customer_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, total_amount DOUBLE PRECISION NOT NULL, transaction_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX UKxwcsepu5t1hoe04v5i8xhk5y (transaction_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, idProduit INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, totalP DOUBLE PRECISION NOT NULL, totalt DOUBLE PRECISION NOT NULL, qty INT NOT NULL, client_id INT NOT NULL, INDEX idProduit (idProduit), INDEX fk_panier_client (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE payments (payment_type VARCHAR(31) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id BIGINT AUTO_INCREMENT NOT NULL, amount NUMERIC(12, 2) NOT NULL, confirmation_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, confirmation_expires_at DATETIME DEFAULT \'NULL\', created_at DATETIME NOT NULL, customer_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, customer_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, transaction_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, provider_name VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, provider_payment_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, UNIQUE INDEX UKlryndveuwa4k5qthti0pkmtlx (transaction_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id BIGINT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, caption TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, media_type ENUM(\'NONE\', \'IMAGE\', \'VIDEO\') CHARACTER SET utf8mb4 DEFAULT \'\'\'NONE\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, media_path VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, thumbnail_path VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, duration_seconds INT DEFAULT NULL, likes_count INT DEFAULT 0 NOT NULL, dislikes_count INT DEFAULT 0 NOT NULL, shares_count INT DEFAULT 0 NOT NULL, comments_count INT DEFAULT 0 NOT NULL, visibility ENUM(\'PUBLIC\', \'FRIENDS\', \'PRIVATE\') CHARACTER SET utf8mb4 DEFAULT \'\'\'PUBLIC\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, status ENUM(\'ACTIVE\', \'HIDDEN\', \'DELETED\') CHARACTER SET utf8mb4 DEFAULT \'\'\'ACTIVE\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, updated_at DATETIME DEFAULT \'NULL\', INDEX author_id (author_id), INDEX idx_post_feed (created_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_reaction (id BIGINT AUTO_INCREMENT NOT NULL, post_id BIGINT NOT NULL, user_id BIGINT NOT NULL, reaction ENUM(\'LIKE\', \'DISLIKE\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, UNIQUE INDEX uq_post_user (post_id, user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_report (id BIGINT AUTO_INCREMENT NOT NULL, post_id BIGINT NOT NULL, reporter_user_id BIGINT NOT NULL, reason VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, UNIQUE INDEX uq_post_reporter (post_id, reporter_user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_share (id BIGINT AUTO_INCREMENT NOT NULL, post_id BIGINT NOT NULL, user_id BIGINT NOT NULL, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, UNIQUE INDEX uq_post_user_share (post_id, user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, price DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, stock INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promo_codes (id BIGINT AUTO_INCREMENT NOT NULL, code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, discount_percent DOUBLE PRECISION NOT NULL, expiration_date DATETIME NOT NULL, usage_limit INT NOT NULL, used_count INT NOT NULL, UNIQUE INDEX UKj9mo0xgfs34t6e3c17anidd83 (code), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, sujet VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'\'\'OPEN\'\'\' NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX fk_reclamation_client (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rendezvous (id_rdv INT AUTO_INCREMENT NOT NULL, appointment_date DATE NOT NULL, appointment_time TIME NOT NULL, status VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'\'\'pending\'\'\' COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, client_id INT NOT NULL, vet_id INT NOT NULL, animal_id INT NOT NULL, disponibilite_id INT NOT NULL, INDEX vet_id (vet_id), INDEX animal_id (animal_id), INDEX disponibilite_id (disponibilite_id), INDEX client_id (client_id), PRIMARY KEY (id_rdv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, reclamation_id INT NOT NULL, admin_id INT NOT NULL, message TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, sender_id INT DEFAULT NULL, sender_type VARCHAR(16) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, rating INT DEFAULT NULL, INDEX fk_reponse_reclamation (reclamation_id), INDEX fk_reponse_admin (admin_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, vet_id INT NOT NULL, rdv_id INT NOT NULL, rating INT NOT NULL, commentaire TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX idx_review_rdv (rdv_id), INDEX idx_review_vet (vet_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, last_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, city VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, role VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, active TINYINT DEFAULT 1, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, id_user INT DEFAULT NULL, name VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, profile_image_path VARCHAR(1024) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, UNIQUE INDEX email (email), UNIQUE INDEX id_user (id_user), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adoption_request ADD CONSTRAINT `adoption_request_ibfk_1` FOREIGN KEY (animal_id) REFERENCES animal (idAnimal)');
        $this->addSql('ALTER TABLE adoption_request ADD CONSTRAINT `fk_adoption_client` FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (parent_comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_reaction ADD CONSTRAINT `fk_comment_reaction_comment` FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT `disponibilite_ibfk_1` FOREIGN KEY (vet_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT `fk_panier_client` FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (idProduit) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT `fk_reclamation_client` FOREIGN KEY (client_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT `rendezvous_ibfk_2` FOREIGN KEY (vet_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT `rendezvous_ibfk_3` FOREIGN KEY (animal_id) REFERENCES animal (idAnimal)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT `rendezvous_ibfk_4` FOREIGN KEY (disponibilite_id) REFERENCES disponibilite (id_disponibilite)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT `fk_reponse_admin` FOREIGN KEY (admin_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT `fk_reponse_reclamation` FOREIGN KEY (reclamation_id) REFERENCES reclamation (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE hotel ADD created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE name name VARCHAR(100) NOT NULL, CHANGE capacity capacity INT NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT `fk_hotel_manager` FOREIGN KEY (manager_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX fk_hotel_manager ON hotel (manager_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553243BB18');
        $this->addSql('ALTER TABLE reservation ADD client_id INT DEFAULT NULL, ADD animal_id INT DEFAULT NULL, ADD start_date DATE NOT NULL, ADD end_date DATE NOT NULL, ADD status VARCHAR(16) DEFAULT \'\'\'PENDING\'\'\' NOT NULL, ADD created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, ADD reservation_date DATE NOT NULL, ADD guest_count INT DEFAULT 1 NOT NULL, ADD nightly_rate NUMERIC(10, 2) DEFAULT \'85.00\' NOT NULL, ADD total_price NUMERIC(10, 2) DEFAULT \'85.00\' NOT NULL, DROP client_name, DROP date, CHANGE hotel_id hotel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT `fk_reservation_animal` FOREIGN KEY (animal_id) REFERENCES animal (idAnimal) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT `fk_reservation_client` FOREIGN KEY (client_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT `fk_reservation_hotel` FOREIGN KEY (hotel_id) REFERENCES hotel (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_reservation_client ON reservation (client_id)');
        $this->addSql('CREATE INDEX fk_reservation_animal ON reservation (animal_id)');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_42c849553243bb18 TO fk_reservation_hotel');
    }
}
