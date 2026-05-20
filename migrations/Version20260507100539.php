<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260507100539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, number, total_ttc, created_at, status FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(255) NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, invoice_item_id INTEGER DEFAULT NULL, CONSTRAINT FK_90651744E0B6648D FOREIGN KEY (invoice_item_id) REFERENCES invoice_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, number, total_ttc, created_at, status) SELECT id, number, total_ttc, created_at, status FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_90651744E0B6648D ON invoice (invoice_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, number, total_ttc, created_at, status FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(255) NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO invoice (id, number, total_ttc, created_at, status) SELECT id, number, total_ttc, created_at, status FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
    }
}
