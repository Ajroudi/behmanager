<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
