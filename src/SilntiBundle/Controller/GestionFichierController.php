<?php

namespace SilntiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GestionFichierController extends Controller
{
    /**
     * @Route("/gestionFichier")
     */
    public function gestionFichierAction()
    {
        return $this->render('SilntiBundle:GestionFichier:gestionFichier.html.twig');
    }
}
