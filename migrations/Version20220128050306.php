<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128050306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prof_classe_classe DROP FOREIGN KEY FK_10B337A82293C02D');
        $this->addSql('ALTER TABLE prof_classe_utilisateur DROP FOREIGN KEY FK_FE5B20192293C02D');
        $this->addSql('DROP TABLE prof_classe');
        $this->addSql('DROP TABLE prof_classe_classe');
        $this->addSql('DROP TABLE prof_classe_utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prof_classe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prof_classe_classe (prof_classe_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_10B337A82293C02D (prof_classe_id), INDEX IDX_10B337A88F5EA509 (classe_id), PRIMARY KEY(prof_classe_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prof_classe_utilisateur (prof_classe_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_FE5B20192293C02D (prof_classe_id), INDEX IDX_FE5B2019FB88E14F (utilisateur_id), PRIMARY KEY(prof_classe_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prof_classe_classe ADD CONSTRAINT FK_10B337A82293C02D FOREIGN KEY (prof_classe_id) REFERENCES prof_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_classe ADD CONSTRAINT FK_10B337A88F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_utilisateur ADD CONSTRAINT FK_FE5B20192293C02D FOREIGN KEY (prof_classe_id) REFERENCES prof_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_classe_utilisateur ADD CONSTRAINT FK_FE5B2019FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }
}
