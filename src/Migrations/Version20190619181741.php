<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619181741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status_documento ADD documento_id INT NOT NULL');
        $this->addSql('ALTER TABLE status_documento ADD CONSTRAINT FK_3E24AE8645C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id)');
        $this->addSql('CREATE INDEX IDX_3E24AE8645C0CF75 ON status_documento (documento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status_documento DROP FOREIGN KEY FK_3E24AE8645C0CF75');
        $this->addSql('DROP INDEX IDX_3E24AE8645C0CF75 ON status_documento');
        $this->addSql('ALTER TABLE status_documento DROP documento_id');
    }
}
