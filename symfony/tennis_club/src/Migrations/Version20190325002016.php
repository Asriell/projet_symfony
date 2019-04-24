<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325002016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE competitions');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE inscriptions');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE topic');
        $this->addSql('ALTER TABLE staff ADD renseignements_id INT NOT NULL, ADD role VARCHAR(255) NOT NULL, DROP role_staff');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF3924968958A FOREIGN KEY (renseignements_id) REFERENCES compte_client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_426EF3924968958A ON staff (renseignements_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competitions (id INT AUTO_INCREMENT NOT NULL, idequipe_competitions INT NOT NULL, division_competitions VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, heure_debut_competitions TIME NOT NULL, lieu_competitions VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, domicile_competitions TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, date_cours DATETIME NOT NULL, duree_cours INT NOT NULL, idcoach_cours INT NOT NULL, effectif_cours INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, idmembre_equipe INT NOT NULL, division_equipe VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE inscriptions (id INT AUTO_INCREMENT NOT NULL, idcours_inscrit INT NOT NULL, idcompte_client INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, idtopic INT NOT NULL, idauteur_post INT NOT NULL, texte_post LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, date_post DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, titre_topic VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, idauteur_topic INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF3924968958A');
        $this->addSql('DROP INDEX UNIQ_426EF3924968958A ON staff');
        $this->addSql('ALTER TABLE staff ADD role_staff VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, DROP renseignements_id, DROP role');
    }
}
