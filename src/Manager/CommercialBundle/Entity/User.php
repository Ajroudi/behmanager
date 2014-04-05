<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Manager\CommercialBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

     /**
     * @ORM\OneToMany(targetEntity="Offre", mappedBy="user")
     */ 
     private $offres;

     /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     */ 
     private $messages;
     
     /**
     * @ORM\OneToMany(targetEntity="Alert", mappedBy="user")
     */ 
     private $alerts;

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
     * @return User
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
        parent::__construct();
        $this->offres = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->alerts = new ArrayCollection();
    }
    /**
     * toString
     */
    public function __toString() {
        return $this->getName();
    }    

    /**
     * Add offres
     *
     * @param \Manager\CommercialBundle\Entity\Offre $offres
     * @return User
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
     * Add messages
     *
     * @param \Manager\CommercialBundle\Entity\Message $messages
     * @return User
     */
    public function addMessage(\Manager\CommercialBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;
    
        return $this;
    }

    /**
     * Remove messages
     *
     * @param \Manager\CommercialBundle\Entity\Message $messages
     */
    public function removeMessage(\Manager\CommercialBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add alerts
     *
     * @param \Manager\CommercialBundle\Entity\Alert $alerts
     * @return User
     */
    public function addAlert(\Manager\CommercialBundle\Entity\Alert $alerts)
    {
        $this->alerts[] = $alerts;
    
        return $this;
    }

    /**
     * Remove alerts
     *
     * @param \Manager\CommercialBundle\Entity\Alert $alerts
     */
    public function removeAlert(\Manager\CommercialBundle\Entity\Alert $alerts)
    {
        $this->alerts->removeElement($alerts);
    }

    /**
     * Get alerts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlerts()
    {
        return $this->alerts;
    }
}