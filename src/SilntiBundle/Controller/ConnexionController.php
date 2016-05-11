<?php
namespace SilntiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SilntiBundle\Model\UserQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class ConnexionController extends Controller
{
	/**
	 * @Route("/connexion")
	 */
	public function connexionAction(Request $request)
    {
        $form = $this->createFormBuilder(null)->add('email', TextType::class, array('label' => 'Adresse e-mail'))
                                              ->add('password', PasswordType::class, array('label' => 'Mot de passe'))
                                              ->add('login', SubmitType::class, array('label' => 'Connexion'))
                                              ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = UserQuery::getUserByCredentials($form->getData()['email'], $form->getData()['password']);
            if($user != null) {
                $session = $request->getSession();
                $session->set('email', $user->getEmail());
                return $this->redirectToRoute('_index');
            }
            //if($user != null) return $this->redirectToRoute('_index');
        }

		$html = $this->container->get('templating')->render('SilntiBundle::Connexion/connexion.html.twig',
			array('form_connexion' => $form->createView()));
		return new Response($html);
	}

    public function deconnexionAction(Request $request) {
        $request->getSession()->clear();
        return $this->redirectToRoute('_index');
    }
}
