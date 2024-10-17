<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013215232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE dette_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dette_entity (id INT NOT NULL, date DATE NOT NULL, montant INT NOT NULL, montant_verse INT DEFAULT NULL, montant_restant INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN dette_entity.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE articles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE articles ALTER ref SET NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER ref TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE articles ALTER libelle SET NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER qte_stock SET NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER prix SET NOT NULL');
        $this->addSql('ALTER TABLE clients ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE dette_entity_id_seq CASCADE');
        $this->addSql('DROP TABLE dette_entity');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE SEQUENCE clients_id_seq');
        $this->addSql('SELECT setval(\'clients_id_seq\', (SELECT MAX(id) FROM clients))');
        $this->addSql('ALTER TABLE clients ALTER id SET DEFAULT nextval(\'clients_id_seq\')');
        $this->addSql('CREATE SEQUENCE articles_id_seq');
        $this->addSql('SELECT setval(\'articles_id_seq\', (SELECT MAX(id) FROM articles))');
        $this->addSql('ALTER TABLE articles ALTER id SET DEFAULT nextval(\'articles_id_seq\')');
        $this->addSql('ALTER TABLE articles ALTER ref DROP NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER ref TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE articles ALTER libelle DROP NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER qte_stock DROP NOT NULL');
        $this->addSql('ALTER TABLE articles ALTER prix DROP NOT NULL');
    }
}
