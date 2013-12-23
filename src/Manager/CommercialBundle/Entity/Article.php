<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="ref", type="string", length=255)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;
    
    /**
     * @ORM\ManyToOne(targetEntity="Fournisseur", inversedBy="articles")
     * @ORM\JoinColumn(name="fournisseur_id", referencedColumnName="id")
     */
    private $fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="Spec", mappedBy="article")
     */
    private $specs;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="article")
     */
    private $lignes;

    /**
     * @ORM\ManyToMany(targetEntity="Rang", inversedBy="articles")
     * @ORM\JoinTable(name="article_range")
     */
    private $rangs;
    
    /**
     * @ORM\ManyToMany(targetEntity="Ressource", inversedBy="articles")
     * @ORM\JoinTable(name="article_ressource")
     */
    private $ressources;
    
    /**
     * Constructeur
     */
    public function __construct() {
        $this->specs = new ArrayCollection();
        $this->lignes = new ArrayCollection();
        $this->rangs = new ArrayCollection();
        $this->ressources = new ArrayCollection();
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
     * Set ref
     *
     * @param string $ref
     * @return Article
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    
        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Article
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    
        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set fournisseur
     *
     * @param \Manager\CommercialBundle\Entity\Fournisseur $fournisseur
     * @return Article
     */
    public function setFournisseur(\Manager\CommercialBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;
    
        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Manager\CommercialBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Add specs
     *
     * @param \Manager\CommercialBundle\Entity\Spec $specs
     * @return Article
     */
    public function addSpec(\Manager\CommercialBundle\Entity\Spec $specs)
    {
        $this->specs[] = $specs;
    
        return $this;
    }

    /**
     * Remove specs
     *
     * @param \Manager\CommercialBundle\Entity\Spec $specs
     */
    public function removeSpec(\Manager\CommercialBundle\Entity\Spec $specs)
    {
        $this->specs->removeElement($specs);
    }

    /**
     * Get specs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpecs()
    {
        return $this->specs;
    }

    /**
     * Add lignes
     *
     * @param \Manager\CommercialBundle\Entity\Ligne $lignes
     * @return Article
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
     * Add rangs
     *
     * @param \Manager\CommercialBundle\Entity\Rang $rangs
     * @return Article
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

    /**
     * Add ressources
     *
     * @param \Manager\CommercialBundle\Entity\Ressource $ressources
     * @return Article
     */
    public function addRessource(\Manager\CommercialBundle\Entity\Ressource $ressources)
    {
        $this->ressources[] = $ressources;
    
        return $this;
    }

    /**
     * Remove ressources
     *
     * @param \Manager\CommercialBundle\Entity\Ressource $ressources
     */
    public function removeRessource(\Manager\CommercialBundle\Entity\Ressource $ressources)
    {
        $this->ressources->removeElement($ressources);
    }

    /**
     * Get ressources
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRessources()
    {
        return $this->ressources;
    }
}