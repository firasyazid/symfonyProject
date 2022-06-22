<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="id_abonnement", columns={"id_abonnement"})})
 * @ORM\Entity
 * @UniqueEntity(
 * fields={"mail"},
 * message="Mail already exists"
 * )
 */
class Client implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp_client", type="string", length=50, nullable=false)
     * @Assert\Length(min="8", minMessage="Please enter a password with at least 8 characters")
     */
    private $mdpClient;

    /**
     * @var \Abonnement
     *
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_abonnement", referencedColumnName="id_abonnement")
     * })
     */
    private $idAbonnement;

    
    public function findByName()
    {
        return $this->entityManager->createQueryBuilder('client')
            ->orderBy('client.nom','DESC')
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string  $nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  string
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  string  $prenom
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of adresse
     *
     * @return  string
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @param  string  $adresse
     *
     * @return  self
     */ 
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;

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
     * Get the value of mdpClient
     *
     * @return  string
     */ 
    public function getMdpClient()
    {
        return $this->mdpClient;
    }

    /**
     * Set the value of mdpClient
     *
     * @param  string  $mdpClient
     *
     * @return  self
     */ 
    public function setMdpClient(string $mdpClient)
    {
        $this->mdpClient = $mdpClient;

        return $this;
    }

    /**
     * Get the value of idAbonnement
     *
     * @return  \Abonnement
     */ 
    public function getIdAbonnement()
    {
        return $this->idAbonnement;
    }

    /**
     * Set the value of idAbonnement
     *
     * @param  \Abonnement  $idAbonnement
     *
     * @return  self
     */ 
    public function setIdAbonnement(?Abonnement $idAbonnement)
    {
        $this->idAbonnement = $idAbonnement;

        return $this;
    }


    public function getRoles(){
        return ['ROLE_Client'];
    }

       /** @see \Serializable::serialize() */
       public function serialize()
       {
           return serialize(array(
               $this->id,
               $this->mail,
               $this->mdpClient,
               // see section on salt below
               // $this->salt,
           ));
       }
   
       /** @see \Serializable::unserialize() */
       public function unserialize($serialized)
       {
           list (
               $this->id,
               $this->mail,
               $this->mdpClient,
               // see section on salt below
               // $this->salt
           ) = unserialize($serialized, array('allowed_classes' => false));
       }
       
    public function getPassword(){}
    public function getSalt(){}
    public function getUsername(){}
    public function eraseCredentials(){}

}
