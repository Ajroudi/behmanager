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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="timbre", type="float")
     */
    private $timbre;

    /**
     * @var float
     *
     * @ORM\Column(name="totalttc", type="float")
     */
    private $totalttc;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="offres")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="offre")
     */
    private $lignes;

    /**
     * Constructeur
     */
    public function __construct() {
        $this->lignes = new ArrayCollection();
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
}