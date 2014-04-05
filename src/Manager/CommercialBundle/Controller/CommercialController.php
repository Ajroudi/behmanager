<?php

namespace Manager\CommercialBundle\Controller;

//use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use \FPDF;
//use Manager\CommercialBundle\Entity\Offre;
//use Manager\CommercialBundle\Form\OffreType;
// Plus besoin de rajouter le use de l'exception dans ce cas
// Mais par contre il faut le use pour les annotations du bundle :
//use JMS\SecurityExtraBundle\Annotation\Secure;

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

        return $this->render('ManagerCommercialBundle:Commercial:offre.html.twig', array(
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
    
     /**
     * Finds and displays a Categories By Famille entity.
     *
     */
        public function categoriesAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Categorie')->findByFamille($id);
        $famille = $em->getRepository('ManagerCommercialBundle:Famille')->find($id);

        return $this->render('ManagerCommercialBundle:Categorie:index.html.twig', array(
            'entities' => $entities,
            'famille'=> $famille,
      ));
    }
    
    
     /**
     * Finds and displays a Categories By Famille entity.
     *
     */
        public function rangesAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Rang')->findByCategorie($id);


        return $this->render('ManagerCommercialBundle:Commercial:range.html.twig', array(
            'entities' => $entities,
      ));
    }
    
     /**
     * Finds and displays a Categories By Famille entity.
     *
     */
        public function rangesProductAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('ManagerCommercialBundle:Article')->findBy(array('id' => $id));
      


        return $this->render('ManagerCommercialBundle:Commercial:product.html.twig', array(
            'entities' => $entities,
      ));
    }
    
     /**
     * Finds and displays a Products By Fournisseur.
     *
     */
        public function produitFournisseurAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Article')->findByFournisseur($id);

        return $this->render('ManagerCommercialBundle:Commercial:product.html.twig', array(
            'entities' => $entities,
      ));
    }
    
        public function testAction(){
            
           // On récupère le service
            
            
           $pdf = new \FPDF();
           $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(40,10,'Hello World!');
            $pdf->Output();
            die();
                               
        }
        
        public function mysendAction()
        { 
            
            $monemail=  $this->container->get('mailer');
            $mail= \Swift_Message::newInstance();
            $mail
                    ->setFrom('gerant.mh.web.services@gmail.com')
                    ->setTo('akrem.ajroudi@gmail.com')
                    ->setSubject('teste')
                    ->setBody(
'<html>' .
' <head></head>' .
' <body>' .
'  Here is an image <img src="' . // Embed the file
     $mail->embed(Swift_Image::fromPath(__DIR__ . 'manager/images/behManagerLogo.png')) .
   '" alt="Image" />' .
'  Rest of message' .
' </body>' .
'</html>',
  'text/html' // Mark the content-type as HTML
);
                    //->setBody($this->renderView('ManagerCommercialBundle:Commercial:dashboard.html.twig'))
                   // $mail->setContentType('text/html');
              $monemail->send($mail); 
              return $this->render('ManagerCommercialBundle:Commercial:dashboard.html.twig');
              
        }
        

}
