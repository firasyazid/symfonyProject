<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TabSeance
 *
 * @ORM\Table(name="tab_seance", indexes={@ORM\Index(name="id_coach", columns={"id_coach"})})
 * @ORM\Entity
 */
class TabSeance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_seance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSeance;

    /**
     * @var string
     *
     * @ORM\Column(name="type_seance", type="string", length=25, nullable=false)
     */
    private $typeSeance;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debut", type="string", length=20, nullable=false)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=20, nullable=false)
     */
    private $dateFin;

    /**
     * @var \TabCoach
     *
     * @ORM\ManyToOne(targetEntity="TabCoach")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_coach", referencedColumnName="id_coach")
     * })
     */
    private $idCoach;



    /**
     * Get the value of idSeance
     *
     * @return  int
     */ 
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * Set the value of idSeance
     *
     * @param  int  $idSeance
     *
     * @return  self
     */ 
    public function setIdSeance(int $idSeance)
    {
        $this->idSeance = $idSeance;

        return $this;
    }

    /**
     * Get the value of typeSeance
     *
     * @return  string
     */ 
    public function getTypeSeance()
    {
        return $this->typeSeance;
    }

    /**
     * Set the value of typeSeance
     *
     * @param  string  $typeSeance
     *
     * @return  self
     */ 
    public function setTypeSeance(string $typeSeance)
    {
        $this->typeSeance = $typeSeance;

        return $this;
    }

    /**
     * Get the value of dateDebut
     *
     * @return  string
     */ 
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set the value of dateDebut
     *
     * @param  string  $dateDebut
     *
     * @return  self
     */ 
    public function setDateDebut(string $dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get the value of dateFin
     *
     * @return  string
     */ 
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set the value of dateFin
     *
     * @param  string  $dateFin
     *
     * @return  self
     */ 
    public function setDateFin(string $dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get the value of idCoach
     *
     * @return  \TabCoach
     */ 
    public function getIdCoach()
    {
        return $this->idCoach;
    }

    /**
     * Set the value of idCoach
     *
     * @param  \TabCoach  $idCoach
     *
     * @return  self
     */ 
    public function setIdCoach(?TabCoach $idCoach)
    {
        $this->idCoach = $idCoach;

        return $this;
    }
}
