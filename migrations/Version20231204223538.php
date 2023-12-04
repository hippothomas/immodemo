<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204223538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE property_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE property_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE property (id INT NOT NULL, type_id INT DEFAULT NULL, agent_id INT NOT NULL, reference VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, photos JSON DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, status SMALLINT NOT NULL, featured BOOLEAN NOT NULL, rooms INT DEFAULT NULL, bedroom INT DEFAULT NULL, living_area DOUBLE PRECISION DEFAULT NULL, total_area DOUBLE PRECISION DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(20) DEFAULT NULL, description TEXT DEFAULT NULL, coordinate_x DOUBLE PRECISION DEFAULT NULL, coordinate_y DOUBLE PRECISION DEFAULT NULL, dpe INT DEFAULT NULL, ges INT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8BF21CDEC54C8C93 ON property (type_id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE3414710B ON property (agent_id)');
        $this->addSql('CREATE TABLE property_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEC54C8C93 FOREIGN KEY (type_id) REFERENCES property_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE3414710B FOREIGN KEY (agent_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE property_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE property_type_id_seq CASCADE');
        $this->addSql('ALTER TABLE property DROP CONSTRAINT FK_8BF21CDEC54C8C93');
        $this->addSql('ALTER TABLE property DROP CONSTRAINT FK_8BF21CDE3414710B');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_type');
    }
}
