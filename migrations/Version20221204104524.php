<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204104524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create admin auth table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            CREATE TABLE admins (
              id SERIAL PRIMARY KEY NOT NULL,
              email varchar(180) NOT NULL,
              password varchar(255)  NOT NULL,
              first_name varchar(80) NOT NULL,
              last_name varchar(80) NOT NULL,
              UNIQUE (email))
        SQL);

        $pass = pg_escape_string('$argon2id$v=19$m=65536,t=4,p=1$9NST+hvkOv65a2wj7KJXBg$bhGnKNmQERITsQnzwuLRij/VxJZiif88x4KletUQYDs');

        $this->addSql(<<<SQL
            INSERT INTO admins (email, password, first_name, last_name)
            VALUES ('test@test.com', :pass, 'Admin', 'Admin')
            SQL,
            ['pass' => $pass]
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE admins');
    }
}
