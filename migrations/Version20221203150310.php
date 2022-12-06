<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221203150310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Client table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            CREATE TABLE client (
                id SERIAL PRIMARY KEY NOT NULL,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(35) NOT NULL,
                UNIQUE (email)
            )
            SQL
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE client');
    }
}
