<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
// N'oubliez pas ce use :
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\ClientRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mf", type="string", length=255)
     */
    private $mf;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

     /**
     * @ORM\OneToMany(targetEntity="Offre", mappedBy="client")
     */ 
    private $offres;
    
    
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
    return '/client';
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

    
    /**
     * toString
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
     * @return Client
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
     * Constructor
     */
    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }
    
    /**
     * Add offres
     *
     * @param \Manager\CommercialBundle\Entity\Offre $offres
     * @return Client
     */
    public function addOffre(\Manager\CommercialBundle\Entity\Offre $offres)
    {
        $this->offres[] = $offres;
    
        return $this;
    }

    /**
     * Remove offres
     *
     * @param \Manager\CommercialBundle\Entity\Offre $offres
     */
    public function removeOffre(\Manager\CommercialBundle\Entity\Offre $offres)
    {
        $this->offres->removeElement($offres);
    }

    /**
     * Get offres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffres()
    {
        return $this->offres;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Client
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Client
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set mf
     *
     * @param string $mf
     * @return Client
     */
    public function setMf($mf)
    {
        $this->mf = $mf;
    
        return $this;
    }

    /**
     * Get mf
     *
     * @return string 
     */
    public function getMf()
    {
        return $this->mf;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Client
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set url
     *
     * @param string $url
     * @return Client
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
     * @return Client
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