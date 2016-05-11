<?php
namespace SilntiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConnexionController extends Controller
{
	/**
	 * @Route("/connexion")
	 */
	public function connexionAction()
	{
		$html = $this->container->get('templating')->render('SilntiBundle::Default/connexion.html.twig');
		return new Response($html);
	}
}
