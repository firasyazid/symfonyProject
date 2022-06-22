<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_abonnement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbonnement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ab", type="string", length=255, nullable=false)
     */
    private $nomAb;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_ab", type="integer", nullable=false)
     */
    private $prixAb;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;



    /**
     * Get the value of idAbonnement
     *
     * @return  int
     */ 
    public function getIdAbonnement()
    {
        return $this->idAbonnement;
    }

    /**
     * Set the value of idAbonnement
     *
     * @param  int  $idAbonnement
     *
     * @return  self
     */ 
    public function setIdAbonnement(int $idAbonnement)
    {
        $this->idAbonnement = $idAbonnement;

        return $this;
    }

    /**
     * Get the value of nomAb
     *
     * @return  string
     */ 
    public function getNomAb()
    {
        return $this->nomAb;
    }

    /**
     * Set the value of nomAb
     *
     * @param  string  $nomAb
     *
     * @return  self
     */ 
    public function setNomAb(string $nomAb)
    {
        $this->nomAb = $nomAb;

        return $this;
    }

    /**
     * Get the value of prixAb
     *
     * @return  int
     */ 
    public function getPrixAb()
    {
        return $this->prixAb;
    }

    /**
     * Set the value of prixAb
     *
     * @param  int  $prixAb
     *
     * @return  self
     */ 
    public function setPrixAb(int $prixAb)
    {
        $this->prixAb = $prixAb;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
