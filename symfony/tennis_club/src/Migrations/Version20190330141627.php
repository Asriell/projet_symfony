<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330141627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription_compte_client DROP FOREIGN KEY FK_125B80F55DAC5993');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_compte_client');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, idcours_id INT NOT NULL, INDEX IDX_5E90F6D6D41A30BD (idcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE inscription_compte_client (inscription_id INT NOT NULL, compte_client_id INT NOT NULL, INDEX IDX_125B80F55DAC5993 (inscription_id), INDEX IDX_125B80F5DA655713 (compte_client_id), PRIMARY KEY(inscription_id, compte_client_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription_compte_client ADD CONSTRAINT FK_125B80F55DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_compte_client ADD CONSTRAINT FK_125B80F5DA655713 FOREIGN KEY (compte_client_id) REFERENCES compte_client (id) ON DELETE CASCADE');
    }
}
