<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="article")
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
    private $user;
    
    /**
     * Constructeur
     */
    public function __construct() {
        $this->lignes = new ArrayCollection();
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
}