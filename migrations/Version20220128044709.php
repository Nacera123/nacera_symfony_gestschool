<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128044709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, exercice_id INT DEFAULT NULL, cycle_id INT DEFAULT NULL, salle VARCHAR(255) DEFAULT NULL, INDEX IDX_8F87BF9689D40298 (exercice_id), INDEX IDX_8F87BF965EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF65260C90409EC (identifiant), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle (id INT AUTO_INCREMENT NOT NULL, exrecice_id INT DEFAULT NULL, parcours VARCHAR(255) NOT NULL, INDEX IDX_B086D193370B1512 (exrecice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, papa_id INT DEFAULT NULL, maman_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), INDEX IDX_ECA105F751E4BF21 (papa_id), INDEX IDX_ECA105F751CCF339 (maman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, periode_id INT DEFAULT NULL, matiere_id INT DEFAULT NULL, eleve_id INT DEFAULT NULL, devoirs NUMERIC(10, 2) DEFAULT NULL, examen NUMERIC(4, 2) DEFAULT NULL, moyenne NUMERIC(4, 2) DEFAULT NULL, INDEX IDX_1323A575F384C1CF (periode_id), INDEX IDX_1323A575F46CD258 (matiere_id), INDEX IDX_1323A575A6CC7B2 (eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, annee INT NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, cycle_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_9014574A5EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, exercice_id INT DEFAULT NULL, trimestre VARCHAR(255) NOT NULL, INDEX IDX_93C32DF389D40298 (exercice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_classe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_classe_classe (prof_classe_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_10B337A82293C02D (prof_classe_id), INDEX IDX_10B337A88F5EA509 (classe_id), PRIMARY KEY(prof_classe_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_classe_utilisateur (prof_classe_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_FE5B20192293C02D (prof_classe_id), INDEX IDX_FE5B2019FB88E14F (utilisateur_id), PRIMARY KEY(prof_classe_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_utilisateur (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, compte_id INT DEFAULT NULL, typeutilisateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3F2C56620 (compte_id), UNIQUE INDEX UNIQ_1D1C63B324351654 (typeutilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9689D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF965EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('ALTER TABLE cycle ADD CONSTRAINT FK_B086D193370B1512 FOREIGN KEY (exrecice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F751E4BF21 FOREIGN KEY (papa_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F751CCF339 FOREIGN KEY (maman_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A5EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('ALTER TABLE periode ADD CONSTRAINT FK_93C32DF389D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE prof_classe_classe ADD CONSTRAINT FK_10B337A82293C02D FOREIGN KEY (prof_classe_id) REFERENCES prof_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_classe ADD CONSTRAINT FK_10B337A88F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_utilisateur ADD CONSTRAINT FK_FE5B20192293C02D FOREIGN KEY (prof_classe_id) REFERENCES prof_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_utilisateur ADD CONSTRAINT FK_FE5B2019FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B324351654 FOREIGN KEY (typeutilisateur_id) REFERENCES type_utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE prof_classe_classe DROP FOREIGN KEY FK_10B337A88F5EA509');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3F2C56620');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF965EC1162');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A5EC1162');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575A6CC7B2');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9689D40298');
        $this->addSql('ALTER TABLE cycle DROP FOREIGN KEY FK_B086D193370B1512');
        $this->addSql('ALTER TABLE periode DROP FOREIGN KEY FK_93C32DF389D40298');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F46CD258');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F384C1CF');
        $this->addSql('ALTER TABLE prof_classe_classe DROP FOREIGN KEY FK_10B337A82293C02D');
        $this->addSql('ALTER TABLE prof_classe_utilisateur DROP FOREIGN KEY FK_FE5B20192293C02D');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B324351654');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F751E4BF21');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F751CCF339');
        $this->addSql('ALTER TABLE prof_classe_utilisateur DROP FOREIGN KEY FK_FE5B2019FB88E14F');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE cycle');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE prof_classe');
        $this->addSql('DROP TABLE prof_classe_classe');
        $this->addSql('DROP TABLE prof_classe_utilisateur');
        $this->addSql('DROP TABLE type_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
