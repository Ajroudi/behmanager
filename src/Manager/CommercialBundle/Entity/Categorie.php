<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Famille", inversedBy="categories")
     * @ORM\JoinColumn(name="famille_id", referencedColumnName="id")
     */
    private $famille;
    
    /**
     * @ORM\OneToMany(targetEntity="Rang", mappedBy="categorie")
     */
    private $rangs;
    
    /**
     * Constructeur
     */
    public function __construct() {
        $this->rangs = new ArrayCollection();
    }
    /**
     * toString()
     */
    public function __toString() {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Categorie
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set famille
     *
     * @param \Manager\CommercialBundle\Entity\Famille $famille
     * @return Categorie
     */
    public function setFamille(\Manager\CommercialBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;
    
        return $this;
    }

    /**
     * Get famille
     *
     * @return \Manager\CommercialBundle\Entity\Famille 
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Add rangs
     *
     * @param \Manager\CommercialBundle\Entity\Rang $rangs
     * @return Categorie
     */
    public function addRang(\Manager\CommercialBundle\Entity\Rang $rangs)
    {
        $this->rangs[] = $rangs;
    
        return $this;
    }

    /**
     * Remove rangs
     *
     * @param \Manager\CommercialBundle\Entity\Rang $rangs
     */
    public function removeRang(\Manager\CommercialBundle\Entity\Rang $rangs)
    {
        $this->rangs->removeElement($rangs);
    }

    /**
     * Get rangs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRangs()
    {
        return $this->rangs;
    }
}