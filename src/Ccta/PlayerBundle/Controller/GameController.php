<?php

namespace Ccta\PlayerBundle\Controller;

use Ccta\PlayerBundle\Entity\Player;
use Ccta\PlayerBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
	public function setActivePlayerAction(Request $request, Player $player)
	{
		$request->getSession()->set('activePlayer', $player);
		$request->getSession()->remove('activeWorld');

		$request->getSession()->getFlashBag()->add('info', 'Le joueur est à présent actif.');

		return $this->redirect($request->headers->get('referer'));
	}

    public function createAction(Request $request)
    {
	    $player = new Player();
	    $form = $this->get('form.factory')->create(new PlayerType(), $player);

	    $form->handleRequest($request);

	    if($form->isValid()) {
		    $em = $this->getDoctrine()->getManager();

		    $player->setUser($this->getUser());

		    $em->persist($player);
		    $em->flush();

		    $request->getSession()->getFlashBag()->add('info', 'Player bien enregistré.');

		    return $this->redirect($this->generateUrl('ccta_core_homepage'));
	    }

	    return $this->render('@CctaPlayer/Game/create.html.twig', array(
		    'form' => $form->createView(),
	    ));
    }

    public function editAction()
    {
        return $this->render('CctaPlayerBundle:Game:edit.html.twig', array(
                // ...
            ));    }

    public function deleteAction()
    {
        return $this->render('CctaPlayerBundle:Game:delete.html.twig', array(
                // ...
            ));    }

}
