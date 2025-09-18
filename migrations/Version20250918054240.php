<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918054240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id BLOB NOT NULL --(DC2Type:uuid)
        , pin VARCHAR(16) NOT NULL, full_name VARCHAR(255) NOT NULL, location_city VARCHAR(120) NOT NULL, location_region VARCHAR(32) NOT NULL, contact_phone VARCHAR(14) NOT NULL, contact_email VARCHAR(80) NOT NULL, credit_score INTEGER NOT NULL, monthly_income_usd NUMERIC(10, 0) NOT NULL, birth_date DATE NOT NULL --(DC2Type:date_immutable)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_clients_pin ON client (pin)');
        $this->addSql('CREATE UNIQUE INDEX uniq_clients_contact_email ON client (contact_email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_clients_contact_phone ON client (contact_phone)');
        $this->addSql('CREATE TABLE loan (id BLOB NOT NULL --(DC2Type:uuid)
        , client_id BLOB NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, amount_usd NUMERIC(15, 2) NOT NULL, period_days INTEGER NOT NULL, interest_rate NUMERIC(6, 4) NOT NULL, start_date DATE NOT NULL --(DC2Type:date_immutable)
        , end_date DATE NOT NULL --(DC2Type:date_immutable)
        , PRIMARY KEY(id), CONSTRAINT FK_C5D30D0319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C5D30D0319EB6921 ON loan (client_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
