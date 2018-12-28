<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228010146 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario ADD cargo VARCHAR(255) DEFAULT NULL, ADD funcao VARCHAR(255) DEFAULT NULL, ADD rg VARCHAR(20) DEFAULT NULL, ADD orgao_rg VARCHAR(20) DEFAULT NULL, ADD rg_profissao VARCHAR(50) DEFAULT NULL, ADD orgao_rg_profissao VARCHAR(50) DEFAULT NULL, ADD coordenador INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario DROP cargo, DROP funcao, DROP rg, DROP orgao_rg, DROP rg_profissao, DROP orgao_rg_profissao, DROP coordenador');
    }
}
