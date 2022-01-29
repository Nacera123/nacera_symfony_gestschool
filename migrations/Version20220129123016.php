<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129123016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle DROP FOREIGN KEY FK_B086D193370B1512');
        $this->addSql('DROP INDEX IDX_B086D193370B1512 ON cycle');
        $this->addSql('ALTER TABLE cycle CHANGE exrecice_id exercice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cycle ADD CONSTRAINT FK_B086D19389D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('CREATE INDEX IDX_B086D19389D40298 ON cycle (exercice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle DROP FOREIGN KEY FK_B086D19389D40298');
        $this->addSql('DROP INDEX IDX_B086D19389D40298 ON cycle');
        $this->addSql('ALTER TABLE cycle CHANGE exercice_id exrecice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cycle ADD CONSTRAINT FK_B086D193370B1512 FOREIGN KEY (exrecice_id) REFERENCES exercice (id)');
        $this->addSql('CREATE INDEX IDX_B086D193370B1512 ON cycle (exrecice_id)');
    }
}
