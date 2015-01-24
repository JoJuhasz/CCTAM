<?php

namespace Ccta\PlayerBundle\Controller;

use Ccta\PlayerBundle\Entity\Player;
use Ccta\PlayerBundle\Form\PlayerAdminType;
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
		$player = new Player();
		$form = $this->get('form.factory')->create(new PlayerAdminType(), $player);

		$form->handleRequest($request);

		if($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($player);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Joueur bien enregistré.');

			return $this->redirect($this->generateUrl('ccta_player_admin_index'));
		}

		return $this->render('@CctaPlayer/Admin/create.html.twig', array(
			'form' => $form->createView(),
		));
	}

	public function editAction(Player $player, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		//var_dump($user); die();

		$form = $this->createForm(new PlayerAdminType(), $player);
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
		$em = $this->getDoctrine()->getManager();

		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) {

			$em->remove($player);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Le joueur a bien été supprimé.");

			return $this->redirect($this->generateUrl('ccta_player_admin_index'));
		}

		// Si la requête est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('CctaPlayerBundle:Admin:delete.html.twig', array(
			'player' => $player,
			'form'   => $form->createView()
		));
	}
}