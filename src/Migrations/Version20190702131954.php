<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190702131954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, bairro_id INT NOT NULL, logradouro VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, cep VARCHAR(255) NOT NULL, INDEX IDX_F8E0D60EA94EF08D (bairro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE endereco ADD CONSTRAINT FK_F8E0D60EA94EF08D FOREIGN KEY (bairro_id) REFERENCES bairro (id)');
        $this->addSql('ALTER TABLE bairro ADD distrito VARCHAR(255) NOT NULL, ADD ativo TINYINT(1) NOT NULL, CHANGE nome nome VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE usuario ADD endereco_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D1BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('CREATE INDEX IDX_2265B05D1BB76823 ON usuario (endereco_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D1BB76823');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('ALTER TABLE bairro DROP distrito, DROP ativo, CHANGE nome nome VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_2265B05D1BB76823 ON usuario');
        $this->addSql('ALTER TABLE usuario DROP endereco_id');
    }
}
