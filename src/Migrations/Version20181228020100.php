<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228020100 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario ADD habitacao_id INT NOT NULL');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF34AF7696 FOREIGN KEY (habitacao_id) REFERENCES habitacao (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7510A3CF34AF7696 ON funcionario (habitacao_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF34AF7696');
        $this->addSql('DROP INDEX UNIQ_7510A3CF34AF7696 ON funcionario');
        $this->addSql('ALTER TABLE funcionario DROP habitacao_id');
    }
}
