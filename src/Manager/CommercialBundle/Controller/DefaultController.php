<?php

namespace Manager\CommercialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ManagerCommercialBundle:Default:index.html.twig');
    }
}
