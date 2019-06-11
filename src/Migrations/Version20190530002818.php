<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190530002818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE secretaria_servicos (secretaria_id INT NOT NULL, servicos_id INT NOT NULL, INDEX IDX_B7DE99EF584CC12E (secretaria_id), INDEX IDX_B7DE99EFE445BE60 (servicos_id), PRIMARY KEY(secretaria_id, servicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secretaria_servicos ADD CONSTRAINT FK_B7DE99EF584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretaria_servicos ADD CONSTRAINT FK_B7DE99EFE445BE60 FOREIGN KEY (servicos_id) REFERENCES servicos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE secretaria_servicos');
    }
}
