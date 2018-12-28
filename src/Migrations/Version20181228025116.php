<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228025116 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_secretaria ADD secretaria_id INT NOT NULL');
        $this->addSql('ALTER TABLE sub_secretaria ADD CONSTRAINT FK_EF56120F584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('CREATE INDEX IDX_EF56120F584CC12E ON sub_secretaria (secretaria_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_secretaria DROP FOREIGN KEY FK_EF56120F584CC12E');
        $this->addSql('DROP INDEX IDX_EF56120F584CC12E ON sub_secretaria');
        $this->addSql('ALTER TABLE sub_secretaria DROP secretaria_id');
    }
}
