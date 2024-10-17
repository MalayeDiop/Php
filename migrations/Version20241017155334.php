<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017155334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_entity (id INT NOT NULL, email VARCHAR(50) NOT NULL, login VARCHAR(50) NOT NULL, password VARCHAR(25) NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_blocked BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN user_entity.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_entity.update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE clients ADD create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE clients ADD update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE clients ADD is_blocked BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN clients.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN clients.update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E74450FF010 ON clients (telephone)');
        $this->addSql('ALTER TABLE dettes DROP date');
        $this->addSql('ALTER TABLE dettes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE dettes ALTER montantverse DROP NOT NULL');
        $this->addSql('ALTER TABLE dettes ALTER montantrestant DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_entity_id_seq CASCADE');
        $this->addSql('DROP TABLE user_entity');
        $this->addSql('DROP INDEX UNIQ_C82E74450FF010');
        $this->addSql('ALTER TABLE clients DROP create_at');
        $this->addSql('ALTER TABLE clients DROP update_at');
        $this->addSql('ALTER TABLE clients DROP is_blocked');
        $this->addSql('ALTER TABLE dettes ADD date DATE NOT NULL');
        $this->addSql('CREATE SEQUENCE dettes_id_seq');
        $this->addSql('SELECT setval(\'dettes_id_seq\', (SELECT MAX(id) FROM dettes))');
        $this->addSql('ALTER TABLE dettes ALTER id SET DEFAULT nextval(\'dettes_id_seq\')');
        $this->addSql('ALTER TABLE dettes ALTER montantverse SET NOT NULL');
        $this->addSql('ALTER TABLE dettes ALTER montantrestant SET NOT NULL');
    }
}
