<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229092855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE composer ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE director ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor DROP first_name, DROP last_name');
        $this->addSql('ALTER TABLE composer DROP first_name, DROP last_name');
        $this->addSql('ALTER TABLE director DROP first_name, DROP last_name');
    }
}
