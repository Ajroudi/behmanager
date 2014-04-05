<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Component\DependencyInjection\ContainerInterface as Container

/**
 * Offre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\OffreRepository")
 */
class Offre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var float
     *
     * @ORM\Column(name="timbre", type="decimal", scale=3)
     */
    private $timbre;
    
    /**
     * @var float
     *
     * @ORM\Column(name="totalttc", type="decimal", scale=3)
     */
    private $totalttc;

     /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="article", cascade={"persist"})
     */ 
    private $lignes;
    
     /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="offres")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    
     /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="offres")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
     public $user;
     
    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
     public $etat;     
    
    /**
     * Constructeur
     */
    public function __construct() {
        $this->lignes = new ArrayCollection();
        $this->date = new \DateTime();
        $this->timbre = 0.400;
        $this->etat = "cree";
        //$user = $this->getUser();
        //$user = $this->Container->get('security.context')->getToken()->getUser();
        //$this->user = $user;

        
    }
    /**
     * toString
     */
    public function __toString() {
        return $this->getTitre();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Offre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Add lignes
     *
     * @param \Manager\CommercialBundle\Entity\Ligne $lignes
     * @return Offre
     */
    public function addLigne(\Manager\CommercialBundle\Entity\Ligne $lignes)
    {
        $lignes->setOffre($this);
        $this->lignes[] = $lignes;
    
        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Manager\CommercialBundle\Entity\Ligne $lignes
     */
    public function removeLigne(\Manager\CommercialBundle\Entity\Ligne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /**
     * Set client
     *
     * @param \Manager\CommercialBundle\Entity\Client $client
     * @return Offre
     */
    public function setClient(\Manager\CommercialBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Manager\CommercialBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param \Manager\CommercialBundle\Entity\User $user
     * @return Offre
     */
    public function setUser(\Manager\CommercialBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Manager\CommercialBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Offre
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set timbre
     *
     * @param float $timbre
     * @return Offre
     */
    public function setTimbre($timbre)
    {
        $this->timbre = $timbre;
    
        return $this;
    }

    /**
     * Get timbre
     *
     * @return float 
     */
    public function getTimbre()
    {
        return $this->timbre;
    }

    /**
     * Set totalttc
     *
     * @param float $totalttc
     * @return Offre
     */
    public function setTotalttc($totalttc)
    {
        $this->totalttc = $totalttc;
    
        return $this;
    }

    /**
     * Get totalttc
     *
     * @return float 
     */
    public function getTotalttc()
    {
        return $this->totalttc;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Offre
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }
}