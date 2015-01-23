<?php

namespace Ccta\WorldBundle\Controller;

use Ccta\WorldBundle\Entity\World;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
	public function setActiveWorldAction(Request $request, World $world)
	{
		$request->getSession()->set('activeWorld', $world);

		$request->getSession()->getFlashBag()->add('info', 'Le monde est à présent actif.');

		return $this->redirect($request->headers->get('referer'));
	}

	public function joinAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$worldId = $request->query->get('world_id');
		$activePlayer = $request->getSession()->get('activePlayer');
		$player = $em->getRepository('CctaPlayerBundle:Player')->find($activePlayer->getId());

		if($worldId) {

			$world = $em->getRepository('CctaWorldBundle:World')->find($worldId);
			$world->addPlayer($player);

			$em->persist($world);
			$em->flush();

			$request->getSession()->remove('activePlayer');
			$request->getSession()->remove('activeWorld');

			return $this->redirect($this->generateUrl('ccta_core_homepage'));
		}

		$worlds = $em->getRepository('CctaWorldBundle:World')
					 ->findAll();


		return $this->render('@CctaWorld/Game/join.html.twig', array(
			'worlds' => $worlds,
			'player_worlds' => $player->getWorlds()
		));


	}
}