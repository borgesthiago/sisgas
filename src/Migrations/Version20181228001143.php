<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228001143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contato (id INT AUTO_INCREMENT NOT NULL, telefone VARCHAR(10) DEFAULT NULL, celular VARCHAR(11) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, secretaria_id INT NOT NULL, remuneracao_id INT DEFAULT NULL, contato_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, matricula VARCHAR(7) NOT NULL, cpf VARCHAR(11) NOT NULL, endereco VARCHAR(255) DEFAULT NULL, status INT NOT NULL, tipo VARCHAR(50) NOT NULL, admissao DATE DEFAULT NULL, exoneracao DATE DEFAULT NULL, UNIQUE INDEX UNIQ_7510A3CF3E3E11F0 (cpf), INDEX IDX_7510A3CF584CC12E (secretaria_id), UNIQUE INDEX UNIQ_7510A3CF3AF70DDF (remuneracao_id), INDEX IDX_7510A3CFB279BE46 (contato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remuneracao (id INT AUTO_INCREMENT NOT NULL, salario DOUBLE PRECISION DEFAULT NULL, gratificacao DOUBLE PRECISION DEFAULT NULL, desconto DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretaria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, endereco VARCHAR(255) NOT NULL, telefone VARCHAR(8) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, funcionario_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649642FEB76 (funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF3AF70DDF FOREIGN KEY (remuneracao_id) REFERENCES remuneracao (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CFB279BE46 FOREIGN KEY (contato_id) REFERENCES contato (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CFB279BE46');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649642FEB76');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF3AF70DDF');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF584CC12E');
        $this->addSql('DROP TABLE contato');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE remuneracao');
        $this->addSql('DROP TABLE secretaria');
        $this->addSql('DROP TABLE user');
    }
}
