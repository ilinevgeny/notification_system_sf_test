<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206172107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add notification table; add many to many relation between notification and client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            CREATE TABLE notification (
                id SERIAL PRIMARY KEY NOT NULL,
                content TEXT NOT NULL
            )
            SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE client_notification (
                client_id INT NOT NULL,
                notification_id INT NOT NULL,
                sent_at TIMESTAMP NULL,
                PRIMARY KEY(client_id, notification_id)
            )
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE client_notification');
    }
}
