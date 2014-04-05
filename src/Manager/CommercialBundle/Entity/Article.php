<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
// N'oubliez pas ce use :
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\ManyToMany(targetEntity="Rang", inversedBy="articles")
     * @ORM\JoinTable(name="range_article")
     */
    private $ranges;
    
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
     * @ORM\ManyToMany(targetEntity="Ressource", mappedBy="articles")
     */
    private $ressources;
    
     /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="article")
     */ 
    private $lignes;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
      // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;
    

  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    // On vérifie si on avait déjà un fichier pour cette entité
    if (null !== $this->url) {
      // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->url;

      // On réinitialise les valeurs des attributs url et alt
      $this->url = null;
      $this->alt = null;
    }
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }

    // Le nom du fichier est son id, on doit juste stocker également son extension
    // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
    $this->url = $this->file->guessExtension();

    // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }

    // Si on avait un ancien fichier, on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « id.extension »
    );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur
    return '/article';
  }

  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/bundles/managercommercial/images'.$this->getUploadDir();
  }

  //Il est donc intéressant d'ajouter une méthode qui fait tout cela dans l'entité
  public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
  }

    public function __construct() {
        $this->ranges = new ArrayCollection();
        $this->specs = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->lignes = new ArrayCollection();

    }
    
    /**
     * toString
     */
    public function __toString(){
    return $this->getDesignation()."<img src=".$this->getWebPath()."/>";
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
     * Add ranges
     *
     * @param \Manager\CommercialBundle\Entity\Rang $ranges
     * @return Article
     */
    public function addRange(\Manager\CommercialBundle\Entity\Rang $ranges)
    {
        $this->ranges[] = $ranges;
    
        return $this;
    }

    /**
     * Remove ranges
     *
     * @param \Manager\CommercialBundle\Entity\Rang $ranges
     */
    public function removeRange(\Manager\CommercialBundle\Entity\Rang $ranges)
    {
        $this->ranges->removeElement($ranges);
    }

    /**
     * Get ranges
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRanges()
    {
        return $this->ranges;
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
     * Set url
     *
     * @param string $url
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Article
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    
        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }
}