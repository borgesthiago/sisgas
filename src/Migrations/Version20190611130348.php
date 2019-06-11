<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611130348 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE documento (id INT AUTO_INCREMENT NOT NULL, origem_id INT DEFAULT NULL, numero_reiteracao_id INT DEFAULT NULL, tipo VARCHAR(50) NOT NULL, numero VARCHAR(255) NOT NULL, data_recebido DATE NOT NULL, prazo INT NOT NULL, reiteracao TINYINT(1) DEFAULT NULL, INDEX IDX_B6B12EC781E73123 (origem_id), INDEX IDX_B6B12EC768FC4D8C (numero_reiteracao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC781E73123 FOREIGN KEY (origem_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC768FC4D8C FOREIGN KEY (numero_reiteracao_id) REFERENCES documento (id)');
        $this->addSql('ALTER TABLE usuario ADD documento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D45C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id)');
        $this->addSql('CREATE INDEX IDX_2265B05D45C0CF75 ON usuario (documento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D45C0CF75');
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC768FC4D8C');
        $this->addSql('DROP TABLE documento');
        $this->addSql('DROP INDEX IDX_2265B05D45C0CF75 ON usuario');
        $this->addSql('ALTER TABLE usuario DROP documento_id');
    }
}
