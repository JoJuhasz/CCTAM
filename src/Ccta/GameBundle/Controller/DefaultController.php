<?php

namespace Ccta\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

	    $session = $request->getSession();
	    $doctrine = $this->getDoctrine();

	    // Check for active player and world
	    if(!$session->has('activePlayer') || !$session->has('activeWorld')) {
		    $request->getSession()->getFlashBag()->add('error', 'Veuillez activer un joueur et un monde avant de jouer');
		    return $this->redirect($this->generateUrl('ccta_core_homepage'));
	    }

	    $player = $doctrine->getRepository('CctaPlayerBundle:Player')->find($session->get('activePlayer')->getId());
	    $world  = $doctrine->getRepository('CctaWorldBundle:World')->find($session->get('activeWorld')->getId());

	    $alliance = $doctrine->getRepository('CctaAllianceBundle:AlliancePlayer')->findOneBy(array(
		    'player' => $player,
		    'world' => $world
	    ));

        return $this->render('CctaGameBundle:Default:index.html.twig', array(
	        'player' => $player,
	        'world' => $world,
	        'alliance' => $alliance
        ));
    }
}
