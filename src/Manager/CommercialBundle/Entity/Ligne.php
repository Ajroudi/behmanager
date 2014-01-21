<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\LigneRepository")
 */
class Ligne
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
     * @var integer
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;

     /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="lignes")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;
    
     /**
     * @ORM\ManyToOne(targetEntity="Offre", inversedBy="lignes")
     * @ORM\JoinColumn(name="offre_id", referencedColumnName="id")
     */
    private $offre;    
    
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
     * Set qte
     *
     * @param integer $qte
     * @return Ligne
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    
        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set article
     *
     * @param \Manager\CommercialBundle\Entity\Article $article
     * @return Ligne
     */
    public function setArticle(\Manager\CommercialBundle\Entity\Article $article = null)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return \Manager\CommercialBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set offre
     *
     * @param \Manager\CommercialBundle\Entity\Offre $offre
     * @return Ligne
     */
    public function setOffre(\Manager\CommercialBundle\Entity\Offre $offre = null)
    {
        $this->offre = $offre;
    
        return $this;
    }

    /**
     * Get offre
     *
     * @return \Manager\CommercialBundle\Entity\Offre 
     */
    public function getOffre()
    {
        return $this->offre;
    }
}