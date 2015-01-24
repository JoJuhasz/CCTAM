<?php

namespace Ccta\PlayerBundle\Controller;

use Ccta\PlayerBundle\Entity\Player;
use Ccta\PlayerBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	public function indexAction()
	{
		$repo = $this->getDoctrine()->getRepository('CctaPlayerBundle:Player');
		$players = $repo->findAll();

		return $this->render('@CctaPlayer/Admin/index.html.twig', array(
			'players' => $players
		));
	}

	public function createAction(Request $request)
	{

	}

	public function editAction(Player $player, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		//var_dump($user); die();

		$form = $this->createForm(new PlayerType(), $player);
		$form->handleRequest($request);

		if($form->isValid()) {
			$em->persist($player);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'Le joueur à bien été modifié.');

			return $this->redirect($this->generateUrl('ccta_player_admin_index'));
		}

		return $this->render('@CctaPlayer/Admin/edit.html.twig', array(
			'form' => $form->createView(),
			'player' => $player
		));
	}

	public function deleteAction(Player $player, Request $request)
	{

	}
}