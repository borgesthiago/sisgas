<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619181221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE status_documento (id INT AUTO_INCREMENT NOT NULL, data DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status ADD status_documento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C8F7ED78A FOREIGN KEY (status_documento_id) REFERENCES status_documento (id)');
        $this->addSql('CREATE INDEX IDX_7B00651C8F7ED78A ON status (status_documento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651C8F7ED78A');
        $this->addSql('DROP TABLE status_documento');
        $this->addSql('DROP INDEX IDX_7B00651C8F7ED78A ON status');
        $this->addSql('ALTER TABLE status DROP status_documento_id');
    }
}
