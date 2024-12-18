<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212101118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE chatroom_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chatroom_entity (id INT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, last_message_user_id INT DEFAULT NULL, last_message_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EBDC377756AE248B ON chatroom_entity (user1_id)');
        $this->addSql('CREATE INDEX IDX_EBDC3777441B8B65 ON chatroom_entity (user2_id)');
        $this->addSql('ALTER TABLE chatroom_entity ADD CONSTRAINT FK_EBDC377756AE248B FOREIGN KEY (user1_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chatroom_entity ADD CONSTRAINT FK_EBDC3777441B8B65 FOREIGN KEY (user2_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE chatroom_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE chatroom_entity DROP CONSTRAINT FK_EBDC377756AE248B');
        $this->addSql('ALTER TABLE chatroom_entity DROP CONSTRAINT FK_EBDC3777441B8B65');
        $this->addSql('DROP TABLE chatroom_entity');
    }
}
