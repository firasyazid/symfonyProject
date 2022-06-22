<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220514165106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id_abonnement INT AUTO_INCREMENT NOT NULL, nom_ab VARCHAR(255) NOT NULL, prix_ab INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id_abonnement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id_categorie INT AUTO_INCREMENT NOT NULL, description_categorie VARCHAR(20) NOT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_abonnement INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, mdp_client VARCHAR(50) NOT NULL, INDEX id_abonnement (id_abonnement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id_f INT AUTO_INCREMENT NOT NULL, id INT DEFAULT NULL, total DOUBLE PRECISION NOT NULL, INDEX facture (id), PRIMARY KEY(id_f)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, numtel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, description VARCHAR(20) NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX id_categorie (id_categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tab_coach (id_coach INT AUTO_INCREMENT NOT NULL, nom_coach VARCHAR(25) NOT NULL, specialite VARCHAR(20) NOT NULL, mail VARCHAR(25) NOT NULL, mdp_coach VARCHAR(25) NOT NULL, PRIMARY KEY(id_coach)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tab_seance (id_seance INT AUTO_INCREMENT NOT NULL, id_coach INT DEFAULT NULL, type_seance VARCHAR(25) NOT NULL, date_debut VARCHAR(20) NOT NULL, date_fin VARCHAR(20) NOT NULL, INDEX id_coach (id_coach), PRIMARY KEY(id_seance)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559098E86C FOREIGN KEY (id_abonnement) REFERENCES abonnement (id_abonnement)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410BF396750 FOREIGN KEY (id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie)');
        $this->addSql('ALTER TABLE tab_seance ADD CONSTRAINT FK_7EDCBA46D1DC2CFC FOREIGN KEY (id_coach) REFERENCES tab_coach (id_coach)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559098E86C');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C9486A13');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410BF396750');
        $this->addSql('ALTER TABLE tab_seance DROP FOREIGN KEY FK_7EDCBA46D1DC2CFC');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE tab_coach');
        $this->addSql('DROP TABLE tab_seance');
    }
}
