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
     * @var float
     *
     * @ORM\Column(name="remise", type="decimal")
     */
    private $remise;

    /**
     * @var float
     *
     * @ORM\Column(name="puht", type="decimal")
     */
    private $puht;
    
    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="decimal")
     */
    private $tva;
    
    /**
     * @var float
     *
     * @ORM\Column(name="puttc", type="decimal")
     */
    private $puttc;
    
    /**
     * @var float
     *
     * @ORM\Column(name="totalttc", type="decimal")
     */
    private $totalttc;
    
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
    public function __toString() {
        return $this->getArticle()->getRef()." : ".$this->getArticle()->getDesignation();
        

    }
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

    /**
     * Set remise
     *
     * @param float $remise
     * @return Ligne
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    
        return $this;
    }

    /**
     * Get remise
     *
     * @return float 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set puht
     *
     * @param float $puht
     * @return Ligne
     */
    public function setPuht($puht)
    {
        $this->puht = $puht;
    
        return $this;
    }

    /**
     * Get puht
     *
     * @return float 
     */
    public function getPuht()
    {
        return $this->puht;
    }

    /**
     * Set tva
     *
     * @param float $tva
     * @return Ligne
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    
        return $this;
    }

    /**
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set puttc
     *
     * @param float $puttc
     * @return Ligne
     */
    public function setPuttc($puttc)
    {
        $this->puttc = $puttc;
    
        return $this;
    }

    /**
     * Get puttc
     *
     * @return float 
     */
    public function getPuttc()
    {
        return $this->puttc;
    }

    /**
     * Set totalttc
     *
     * @param float $totalttc
     * @return Ligne
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