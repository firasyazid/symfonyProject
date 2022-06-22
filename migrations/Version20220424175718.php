<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424175718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE panier');
        $this->addSql('ALTER TABLE client CHANGE id_abonnement id_abonnement INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier (id_p INT AUTO_INCREMENT NOT NULL, id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX FK_PANIER (id), PRIMARY KEY(id_p)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_PANIER FOREIGN KEY (id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_PersonOrder FOREIGN KEY (id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE client CHANGE id_abonnement id_abonnement INT NOT NULL');
        $this->addSql('ALTER TABLE facture CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD updated_at DATETIME NOT NULL');
    }
}
