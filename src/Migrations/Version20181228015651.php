<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228015651 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipamento (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitacao (id INT AUTO_INCREMENT NOT NULL, endereco VARCHAR(255) DEFAULT NULL, bairro VARCHAR(100) DEFAULT NULL, cidade VARCHAR(100) DEFAULT NULL, cep VARCHAR(20) DEFAULT NULL, tipo_imovel VARCHAR(10) DEFAULT NULL, tipo_construcao VARCHAR(20) DEFAULT NULL, situacao VARCHAR(30) DEFAULT NULL, saneamento INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_secretaria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE funcionario DROP endereco, DROP bairro, DROP cidade');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE equipamento');
        $this->addSql('DROP TABLE habitacao');
        $this->addSql('DROP TABLE sub_secretaria');
        $this->addSql('ALTER TABLE funcionario ADD endereco VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD bairro VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD cidade VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
