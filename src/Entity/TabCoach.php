<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TabCoach
 *
 * @ORM\Table(name="tab_coach")
 * @ORM\Entity
 */
class TabCoach
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_coach", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCoach;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_coach", type="string", length=25, nullable=false)
     */
    private $nomCoach;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=20, nullable=false)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=25, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp_coach", type="string", length=25, nullable=false)
     */
    private $mdpCoach;



    /**
     * Get the value of idCoach
     *
     * @return  int
     */ 
    public function getIdCoach()
    {
        return $this->idCoach;
    }

    /**
     * Set the value of idCoach
     *
     * @param  int  $idCoach
     *
     * @return  self
     */ 
    public function setIdCoach(int $idCoach)
    {
        $this->idCoach = $idCoach;

        return $this;
    }

    /**
     * Get the value of nomCoach
     *
     * @return  string
     */ 
    public function getNomCoach()
    {
        return $this->nomCoach;
    }

    /**
     * Set the value of nomCoach
     *
     * @param  string  $nomCoach
     *
     * @return  self
     */ 
    public function setNomCoach(string $nomCoach)
    {
        $this->nomCoach = $nomCoach;

        return $this;
    }

    /**
     * Get the value of specialite
     *
     * @return  string
     */ 
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set the value of specialite
     *
     * @param  string  $specialite
     *
     * @return  self
     */ 
    public function setSpecialite(string $specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get the value of mail
     *
     * @return  string
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @param  string  $mail
     *
     * @return  self
     */ 
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of mdpCoach
     *
     * @return  string
     */ 
    public function getMdpCoach()
    {
        return $this->mdpCoach;
    }

    /**
     * Set the value of mdpCoach
     *
     * @param  string  $mdpCoach
     *
     * @return  self
     */ 
    public function setMdpCoach(string $mdpCoach)
    {
        $this->mdpCoach = $mdpCoach;

        return $this;
    }
}
