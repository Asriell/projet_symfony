<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325012102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competitions (id INT AUTO_INCREMENT NOT NULL, idequipe INT NOT NULL, division VARCHAR(30) NOT NULL, heure_debut TIME NOT NULL, lieu VARCHAR(255) NOT NULL, domicile TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, idcoach_cours_id INT DEFAULT NULL, date_cours DATETIME NOT NULL, duree_cours INT NOT NULL, effectif_cours INT NOT NULL, INDEX IDX_FDCA8C9C170BF0B1 (idcoach_cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, idmembre INT NOT NULL, division VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, idcours_id INT NOT NULL, idcompte_client_id INT NOT NULL, INDEX IDX_5E90F6D6D41A30BD (idcours_id), INDEX IDX_5E90F6D64EE07377 (idcompte_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, idtopic_id INT NOT NULL, idauteur_post_id INT DEFAULT NULL, texte_post LONGTEXT NOT NULL, date_post DATETIME NOT NULL, INDEX IDX_5A8A6C8DB5806830 (idtopic_id), INDEX IDX_5A8A6C8DE4D35102 (idauteur_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, idauteur_topic_id INT NOT NULL, titre_topic VARCHAR(255) NOT NULL, INDEX IDX_9D40DE1BC32C77A0 (idauteur_topic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C170BF0B1 FOREIGN KEY (idcoach_cours_id) REFERENCES staff (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D64EE07377 FOREIGN KEY (idcompte_client_id) REFERENCES compte_client (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB5806830 FOREIGN KEY (idtopic_id) REFERENCES topic (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DE4D35102 FOREIGN KEY (idauteur_post_id) REFERENCES compte_client (id)');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BC32C77A0 FOREIGN KEY (idauteur_topic_id) REFERENCES compte_client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D41A30BD');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB5806830');
        $this->addSql('DROP TABLE competitions');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE topic');
    }
}
