<?php

namespace SilntiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GestionPageController extends Controller
{
    /**
     * @Route("/gestionPage")
     */
    public function gestionPageAction()
    {
        return $this->render('SilntiBundle:GestionPage:gestionPage.html.twig');
    }
}