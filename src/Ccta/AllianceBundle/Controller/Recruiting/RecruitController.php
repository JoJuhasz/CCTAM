<?php

namespace Ccta\AllianceBundle\Controller\Recruiting;

use Ccta\AllianceBundle\Entity\Recruit;
use Ccta\AllianceBundle\Form\RecruitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RecruitController extends Controller
{

	public function recruitersAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$player = $em->getRepository('CctaPlayerBundle:Player')->find($request->getSession()->get('activePlayer')->getId());
		$world  = $em->getRepository('CctaWorldBundle:World')->find($request->getSession()->get('activeWorld')->getId());

		$alliances = $em->getRepository('CctaAllianceBundle:Alliance')->findBy(array(
			'world' => $world,
			'recruitStatus' => 1
		));

		return $this->render('@CctaAlliance/Recruiting/Recruit/reruiters.html.twig', array(
			'alliances' => $alliances
		));

	}

	public function applyAction($allianceId, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$player = $em->getRepository('CctaPlayerBundle:Player')->find($request->getSession()->get('activePlayer')->getId());
		$world  = $em->getRepository('CctaWorldBundle:World')->find($request->getSession()->get('activeWorld')->getId());
		$alliance = $em->getRepository('CctaAllianceBundle:Alliance')->find($allianceId);

		$recruit = new Recruit();

		$form = $this->createForm(new RecruitType(), $recruit);
		$form->handleRequest($request);

		if($form->isValid()) {

			$recruit->setPlayer($player);
			$recruit->setAlliance($alliance);

			$em->persist($recruit);
			$em->flush();

			$request->getSession()->getFlashBag()->add('success', 'Votre candidature à bien été envoyée.');

			return $this->redirect($this->generateUrl('ccta_game_index'));

		}


		return $this->render('@CctaAlliance/Recruiting/Recruit/apply.html.twig', array(
			'player' => $player,
			'world' => $world,
			'alliance' => $alliance,
			'form' => $form->createView()
		));


	}

	public function recruitsAction(Request $request)
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

		$recruits = $doctrine->getRepository('CctaAllianceBundle:Recruit')->findByAlliance($alliance->getAlliance());


		return $this->render('@CctaAlliance/Recruiting/Recruit/recruits.html.twig', array(
			'recruits' => $recruits,
			'alliance' => $alliance
		));
	}
}