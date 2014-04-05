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
class DashboardController extends Controller
{

    /**
     * Lists all dashboard entities.
     *
     */
    public function showAction()
    {

        
        return $this->render('ManagerCommercialBundle:Commercial:dashboard.html.twig'
        );
    }
    
    public function offrecreeAction(){
        
        return $this->render('ManagerCommercialBundle:Commercial:offrecree.html.twig');
    }
    
    public function offrevalideAction(){
            
        return $this->render('ManagerCommercialBundle:Commercial:offrevalide.html.twig');
    }

    public function offreenvoyeAction(){
            
        return $this->render('ManagerCommercialBundle:Commercial:offreenvoye.html.twig');
    }
    
    public function offrefactureAction(){
            
        return $this->render('ManagerCommercialBundle:Commercial:offrefacture.html.twig');
    }
  
 
    

    
 
}
