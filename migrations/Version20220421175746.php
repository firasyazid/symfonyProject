<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421175746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD updated_at DATETIME NOT NULL, CHANGE id_categorie id_categorie INT DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tab_seance CHANGE id_coach id_coach INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP updated_at, CHANGE id_categorie id_categorie INT NOT NULL, CHANGE name name VARCHAR(20) NOT NULL, CHANGE image image VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE tab_seance CHANGE id_coach id_coach INT NOT NULL');
    }
}
