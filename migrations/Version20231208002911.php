<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208002911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE location_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE location (id INT NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, coordinate_x DOUBLE PRECISION DEFAULT NULL, coordinate_y DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E9E89CB772E836A ON location (identifier)');
        $this->addSql('ALTER TABLE property ADD location_id INT NOT NULL');
        $this->addSql('ALTER TABLE property DROP city');
        $this->addSql('ALTER TABLE property DROP postal_code');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE64D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8BF21CDE64D218E ON property (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE property DROP CONSTRAINT FK_8BF21CDE64D218E');
        $this->addSql('DROP SEQUENCE location_id_seq CASCADE');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP INDEX IDX_8BF21CDE64D218E');
        $this->addSql('ALTER TABLE property ADD city VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD postal_code VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE property DROP location_id');
    }
}
