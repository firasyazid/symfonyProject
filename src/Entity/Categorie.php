<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description_categorie", type="string", length=20, nullable=false)
     */
    private $descriptionCategorie;



    /**
     * Get the value of idCategorie
     *
     * @return  int
     */ 
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set the value of idCategorie
     *
     * @param  int  $idCategorie
     *
     * @return  self
     */ 
    public function setIdCategorie(int $idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * Get the value of descriptionCategorie
     *
     * @return  string
     */ 
    public function getDescriptionCategorie()
    {
        return $this->descriptionCategorie;
    }

    /**
     * Set the value of descriptionCategorie
     *
     * @param  string  $descriptionCategorie
     *
     * @return  self
     */ 
    public function setDescriptionCategorie(string $descriptionCategorie)
    {
        $this->descriptionCategorie = $descriptionCategorie;

        return $this;
    }

     
}
