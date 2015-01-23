<?php

namespace Ccta\WorldBundle\Controller;

use Ccta\WorldBundle\Entity\World;
use Ccta\WorldBundle\Form\WorldType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	public function indexAction()
	{
		$repo = $this->getDoctrine()->getRepository('CctaWorldBundle:World');
		$worlds = $repo->findAll();

		return $this->render('@CctaWorld/Admin/index.html.twig', array(
			'worlds' => $worlds
		));
	}

	public function createAction(Request $request)
	{
		$world = new World();
		$form = $this->get('form.factory')->create(new WorldType(), $world);

		$form->handleRequest($request);

		if($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($world);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Monde bien enregistré.');

			return $this->redirect($this->generateUrl('ccta_world_admin_index'));
		}

		return $this->render('@CctaWorld/Admin/create.html.twig', array(
			'form' => $form->createView(),
		));
	}

	public function editAction(World $world, Request $request)
	{

		$em = $this->getDoctrine()->getManager();

		$form = $this->createForm(new WorldType(), $world);
		$form->handleRequest($request);

		if($form->isValid()) {
			$em->persist($world);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'Le monde à bien été modifié.');

			return $this->redirect($this->generateUrl('ccta_world_admin_index'));
		}

		return $this->render('@CctaWorld/Admin/edit.html.twig', array(
			'form' => $form->createView(),
			'world' => $world
		));
	}

	public function deleteAction()
	{

	}
}