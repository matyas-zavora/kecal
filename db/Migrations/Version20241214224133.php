<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration to add chatroom_id column and adjust sent_at type.
 */
final class Version20241214224133 extends AbstractMigration
{
	public function getDescription(): string
	{
		return 'Adds a chatroom_id column to message_entity and adjusts the sent_at column to be a timestamp without time zone.';
	}

	public function up(Schema $schema): void
	{
		$this->addSql('ALTER TABLE message_entity ADD chatroom_id INT NOT NULL');
		$this->addSql('ALTER TABLE message_entity ALTER sent_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE USING sent_at::TIMESTAMP(0) WITHOUT TIME ZONE');
		$this->addSql('ALTER TABLE message_entity ADD CONSTRAINT FK_390FD967CAF8A031 FOREIGN KEY (chatroom_id) REFERENCES chatroom_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
		$this->addSql('CREATE INDEX IDX_390FD967CAF8A031 ON message_entity (chatroom_id)');
	}

	public function down(Schema $schema): void
	{
		$this->addSql('ALTER TABLE message_entity DROP CONSTRAINT FK_390FD967CAF8A031');
		$this->addSql('DROP INDEX IDX_390FD967CAF8A031');
		$this->addSql('ALTER TABLE message_entity DROP chatroom_id');
		$this->addSql('ALTER TABLE message_entity ALTER sent_at TYPE TEXT USING sent_at::TEXT');
	}
}
