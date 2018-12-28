<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228182643 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sub_secretaria');
        $this->addSql('ALTER TABLE secretaria ADD secretaria_pai_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaria ADD CONSTRAINT FK_C39D81C2FBAF5A21 FOREIGN KEY (secretaria_pai_id) REFERENCES secretaria (id)');
        $this->addSql('CREATE INDEX IDX_C39D81C2FBAF5A21 ON secretaria (secretaria_pai_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sub_secretaria (id INT AUTO_INCREMENT NOT NULL, secretaria_id INT NOT NULL, nome VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_EF56120F584CC12E (secretaria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sub_secretaria ADD CONSTRAINT FK_EF56120F584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE secretaria DROP FOREIGN KEY FK_C39D81C2FBAF5A21');
        $this->addSql('DROP INDEX IDX_C39D81C2FBAF5A21 ON secretaria');
        $this->addSql('ALTER TABLE secretaria DROP secretaria_pai_id');
    }
}
