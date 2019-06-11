<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611133814 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tramitacao (id INT AUTO_INCREMENT NOT NULL, origem_id INT NOT NULL, funcionario_origem_id INT NOT NULL, funcionario_destino_id INT DEFAULT NULL, destino_id INT DEFAULT NULL, status_id INT NOT NULL, data_inicio DATETIME NOT NULL, data_fim DATETIME DEFAULT NULL, observacao VARCHAR(255) DEFAULT NULL, INDEX IDX_7F14F06A81E73123 (origem_id), INDEX IDX_7F14F06A5A0DB59C (funcionario_origem_id), INDEX IDX_7F14F06ABF33428C (funcionario_destino_id), INDEX IDX_7F14F06AE4360615 (destino_id), UNIQUE INDEX UNIQ_7F14F06A6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A81E73123 FOREIGN KEY (origem_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A5A0DB59C FOREIGN KEY (funcionario_origem_id) REFERENCES funcionario (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06ABF33428C FOREIGN KEY (funcionario_destino_id) REFERENCES funcionario (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06AE4360615 FOREIGN KEY (destino_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A6BF700BD');
        $this->addSql('DROP TABLE tramitacao');
        $this->addSql('DROP TABLE status');
    }
}
