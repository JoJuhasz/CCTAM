<?php

namespace Ccta\AllianceBundle\Controller;

use Ccta\AllianceBundle\Entity\Alliance;
use Ccta\AllianceBundle\Entity\AlliancePlayer;
use Ccta\AllianceBundle\Form\AllianceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{

	public function createAction(Request $request)
	{
		$alliance = new Alliance();
		$form = $this->get('form.factory')->create(new AllianceType(), $alliance);

		$form->handleRequest($request);

		if($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$player = $this->getDoctrine()->getRepository('CctaPlayerBundle:Player')->find($request->getSession()->get('activePlayer')->getId());
			$world  = $this->getDoctrine()->getRepository('CctaWorldBundle:World')->find($request->getSession()->get('activeWorld')->getId());

			$alliancePlayer = new AlliancePlayer();
			$alliancePlayer->setRole('CCTA_ROLE_ALLIANCE_OWNER');
			$alliancePlayer->setPlayer($player);
			$alliancePlayer->setAlliance($alliance);
			$alliancePlayer->setWorld($world);

			$alliance->setWorld($world);
			$alliance->addPlayer($alliancePlayer);


			$em->persist($alliance);
			$em->persist($alliancePlayer);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'Alliance bien enregistrée.');

			return $this->redirect($this->generateUrl('ccta_core_homepage'));
		}

		return $this->render('@CctaAlliance/Game/create.html.twig', array(
			'form' => $form->createView(),
		));
	}
}