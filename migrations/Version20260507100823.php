<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260507100823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, quantity FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity INTEGER NOT NULL, product_id INTEGER DEFAULT NULL, CONSTRAINT FK_1DDE477B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_item (id, quantity) SELECT id, quantity FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B4584665A ON invoice_item (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, quantity FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO invoice_item (id, quantity) SELECT id, quantity FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
    }
}
