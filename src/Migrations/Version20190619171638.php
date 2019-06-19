<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619171638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE remuneracao (id INT AUTO_INCREMENT NOT NULL, salario DOUBLE PRECISION DEFAULT NULL, gratificacao DOUBLE PRECISION DEFAULT NULL, desconto DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretaria (id INT AUTO_INCREMENT NOT NULL, secretaria_pai_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, endereco VARCHAR(255) DEFAULT NULL, telefone VARCHAR(8) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, equipamento TINYINT(1) DEFAULT NULL, INDEX IDX_C39D81C2FBAF5A21 (secretaria_pai_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretaria_servicos (secretaria_id INT NOT NULL, servicos_id INT NOT NULL, INDEX IDX_B7DE99EF584CC12E (secretaria_id), INDEX IDX_B7DE99EFE445BE60 (servicos_id), PRIMARY KEY(secretaria_id, servicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documento (id INT AUTO_INCREMENT NOT NULL, origem_id INT DEFAULT NULL, numero_reiteracao_id INT DEFAULT NULL, tipo VARCHAR(50) NOT NULL, numero VARCHAR(255) NOT NULL, data_recebido DATE NOT NULL, prazo INT NOT NULL, reiteracao TINYINT(1) DEFAULT NULL, INDEX IDX_B6B12EC781E73123 (origem_id), INDEX IDX_B6B12EC768FC4D8C (numero_reiteracao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, documento_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) DEFAULT NULL, rg VARCHAR(20) DEFAULT NULL, orgao_rg VARCHAR(20) DEFAULT NULL, data_nascimento DATE DEFAULT NULL, email VARCHAR(200) DEFAULT NULL, sexo VARCHAR(1) DEFAULT NULL, pcd INT DEFAULT NULL, naturalidade VARCHAR(100) DEFAULT NULL, profissao VARCHAR(255) DEFAULT NULL, ocupacao VARCHAR(255) DEFAULT NULL, renda DOUBLE PRECISION DEFAULT NULL, ctps VARCHAR(20) DEFAULT NULL, serie_ctps VARCHAR(20) DEFAULT NULL, escolaridade VARCHAR(40) DEFAULT NULL, nis VARCHAR(30) DEFAULT NULL, INDEX IDX_2265B05D45C0CF75 (documento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, secretaria_id INT NOT NULL, remuneracao_id INT DEFAULT NULL, contato_id INT DEFAULT NULL, habitacao_id INT NOT NULL, nome VARCHAR(255) NOT NULL, matricula VARCHAR(7) NOT NULL, cpf VARCHAR(11) NOT NULL, status INT NOT NULL, tipo VARCHAR(50) NOT NULL, admissao DATE DEFAULT NULL, exoneracao DATE DEFAULT NULL, cargo VARCHAR(255) DEFAULT NULL, funcao VARCHAR(255) DEFAULT NULL, rg VARCHAR(20) DEFAULT NULL, orgao_rg VARCHAR(20) DEFAULT NULL, rg_profissao VARCHAR(50) DEFAULT NULL, orgao_rg_profissao VARCHAR(50) DEFAULT NULL, coordenador INT DEFAULT NULL, UNIQUE INDEX UNIQ_7510A3CF3E3E11F0 (cpf), INDEX IDX_7510A3CF584CC12E (secretaria_id), UNIQUE INDEX UNIQ_7510A3CF3AF70DDF (remuneracao_id), INDEX IDX_7510A3CFB279BE46 (contato_id), UNIQUE INDEX UNIQ_7510A3CF34AF7696 (habitacao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramitacao (id INT AUTO_INCREMENT NOT NULL, origem_id INT NOT NULL, funcionario_origem_id INT NOT NULL, funcionario_destino_id INT DEFAULT NULL, destino_id INT DEFAULT NULL, documento_id INT NOT NULL, data_inicio DATETIME NOT NULL, data_fim DATETIME DEFAULT NULL, observacao VARCHAR(255) DEFAULT NULL, INDEX IDX_7F14F06A81E73123 (origem_id), INDEX IDX_7F14F06A5A0DB59C (funcionario_origem_id), INDEX IDX_7F14F06ABF33428C (funcionario_destino_id), INDEX IDX_7F14F06AE4360615 (destino_id), INDEX IDX_7F14F06A45C0CF75 (documento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bairro (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contato (id INT AUTO_INCREMENT NOT NULL, telefone VARCHAR(10) DEFAULT NULL, celular VARCHAR(11) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, funcionario_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649642FEB76 (funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitacao (id INT AUTO_INCREMENT NOT NULL, endereco VARCHAR(255) DEFAULT NULL, bairro VARCHAR(100) DEFAULT NULL, cidade VARCHAR(100) DEFAULT NULL, cep VARCHAR(20) DEFAULT NULL, tipo_imovel VARCHAR(10) DEFAULT NULL, tipo_construcao VARCHAR(20) DEFAULT NULL, situacao VARCHAR(30) DEFAULT NULL, saneamento INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicos (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(150) DEFAULT NULL, status INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secretaria ADD CONSTRAINT FK_C39D81C2FBAF5A21 FOREIGN KEY (secretaria_pai_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE secretaria_servicos ADD CONSTRAINT FK_B7DE99EF584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretaria_servicos ADD CONSTRAINT FK_B7DE99EFE445BE60 FOREIGN KEY (servicos_id) REFERENCES servicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC781E73123 FOREIGN KEY (origem_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC768FC4D8C FOREIGN KEY (numero_reiteracao_id) REFERENCES documento (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D45C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF3AF70DDF FOREIGN KEY (remuneracao_id) REFERENCES remuneracao (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CFB279BE46 FOREIGN KEY (contato_id) REFERENCES contato (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF34AF7696 FOREIGN KEY (habitacao_id) REFERENCES habitacao (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A81E73123 FOREIGN KEY (origem_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A5A0DB59C FOREIGN KEY (funcionario_origem_id) REFERENCES funcionario (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06ABF33428C FOREIGN KEY (funcionario_destino_id) REFERENCES funcionario (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06AE4360615 FOREIGN KEY (destino_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE tramitacao ADD CONSTRAINT FK_7F14F06A45C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF3AF70DDF');
        $this->addSql('ALTER TABLE secretaria DROP FOREIGN KEY FK_C39D81C2FBAF5A21');
        $this->addSql('ALTER TABLE secretaria_servicos DROP FOREIGN KEY FK_B7DE99EF584CC12E');
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC781E73123');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF584CC12E');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A81E73123');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06AE4360615');
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC768FC4D8C');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D45C0CF75');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A45C0CF75');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06A5A0DB59C');
        $this->addSql('ALTER TABLE tramitacao DROP FOREIGN KEY FK_7F14F06ABF33428C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649642FEB76');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CFB279BE46');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF34AF7696');
        $this->addSql('ALTER TABLE secretaria_servicos DROP FOREIGN KEY FK_B7DE99EFE445BE60');
        $this->addSql('DROP TABLE remuneracao');
        $this->addSql('DROP TABLE secretaria');
        $this->addSql('DROP TABLE secretaria_servicos');
        $this->addSql('DROP TABLE documento');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE tramitacao');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE bairro');
        $this->addSql('DROP TABLE contato');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE habitacao');
        $this->addSql('DROP TABLE servicos');
    }
}
