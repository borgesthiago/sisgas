<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611134049 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tramitacao ADD documento_id INT NOT NULL');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A45C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id)');
        $this->addSql('CREATE INDEX IDX_7F14F06A45C0CF75 ON tramitacao (documento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A45C0CF75');
        $this->addSql('DROP INDEX IDX_7F14F06A45C0CF75 ON tramitacao');
        $this->addSql('ALTER TABLE tramitacao DROP documento_id');
    }
}
