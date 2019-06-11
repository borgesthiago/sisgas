<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228232302 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicos DROP FOREIGN KEY FK_89DD09E3584CC12E');
        $this->addSql('DROP INDEX IDX_89DD09E3584CC12E ON servicos');
        $this->addSql('ALTER TABLE servicos DROP secretaria_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicos ADD secretaria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE servicos ADD CONSTRAINT FK_89DD09E3584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('CREATE INDEX IDX_89DD09E3584CC12E ON servicos (secretaria_id)');
    }
}
