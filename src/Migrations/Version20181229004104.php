<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181229004104 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) DEFAULT NULL, rg VARCHAR(20) DEFAULT NULL, orgao_rg VARCHAR(20) DEFAULT NULL, data_nascimento DATE DEFAULT NULL, email VARCHAR(200) DEFAULT NULL, sexo VARCHAR(1) DEFAULT NULL, pcd INT DEFAULT NULL, naturalidade VARCHAR(100) DEFAULT NULL, profissao VARCHAR(255) DEFAULT NULL, ocupacao VARCHAR(255) DEFAULT NULL, renda DOUBLE PRECISION DEFAULT NULL, ctps VARCHAR(20) DEFAULT NULL, serie_ctps VARCHAR(20) DEFAULT NULL, escolaridade VARCHAR(40) DEFAULT NULL, nis VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE usuario');
    }
}
