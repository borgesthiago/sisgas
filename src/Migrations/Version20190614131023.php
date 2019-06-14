<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614131023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status DROP tramitacao_id');
        $this->addSql('ALTER TABLE tramitacao ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_7F14F06A6BF700BD ON tramitacao (status_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status ADD tramitacao_id INT NOT NULL');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A6BF700BD');
        $this->addSql('DROP INDEX IDX_7F14F06A6BF700BD ON tramitacao');
        $this->addSql('ALTER TABLE tramitacao DROP status_id');
    }
}
