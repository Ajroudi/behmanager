<?php

namespace Manager\CommercialBundle\Controller;

//use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Manager\CommercialBundle\Entity\Offre;
//use Manager\CommercialBundle\Form\OffreType;

/**
 * Commercial controller.
 *
 */
class CommercialController extends Controller
{

    /**
     * Lists all Offre entities.
     *
     */
    public function offreAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Offre')->findAll();

        return $this->render('ManagerCommercialBundle:Offre:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
     /**
     * Lists all Fournisseurs entities.
     *
     */
    public function fournisseurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Fournisseur')->findAll();

        return $this->render('ManagerCommercialBundle:Fournisseur:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
     /**
     * Lists all Familles entities.
     *
     */
    public function familleAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Famille')->findAll();

        return $this->render('ManagerCommercialBundle:Famille:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
     /**
     * Lists all Clients entities.
     *
     */
    public function clientAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Client')->findAll();

        return $this->render('ManagerCommercialBundle:Client:index.html.twig', array(
            'entities' => $entities,
        ));
    }

     /**
     * Lists all Ressources entities.
     *
     */
    public function ressourceAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Ressource')->findAll();

        return $this->render('ManagerCommercialBundle:Ressource:index.html.twig', array(
            'entities' => $entities,
        ));
    }
 
}
