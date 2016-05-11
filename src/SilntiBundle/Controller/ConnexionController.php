<?php
namespace SilntiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConnexionController extends Controller
{
	/**
	 * @Route("/connexion")
	 */
	public function connexionAction()
	{
        $form = $this->createFormBuilder(null)->add('username', TextType::class, array('label' => 'Nom d\'utilisateur'))
                                              ->add('password', PasswordType::class, array('label' => 'Mot de passe'))
                                              ->add('login', SubmitType::class, array('label' => 'Connexion'))
                                              ->getForm();

		$html = $this->container->get('templating')->render('SilntiBundle::Default/connexion.html.twig',
			array('form_connexion' => $form->createView()));
		return new Response($html);
	}
}
