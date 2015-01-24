<?php

namespace Ccta\AllianceBundle\Controller;

use Ccta\AllianceBundle\Entity\Alliance;
use Ccta\AllianceBundle\Form\AllianceAdminType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
		$alliances = $em->getRepository('CctaAllianceBundle:Alliance')->findAll();

		return $this->render('@CctaAlliance/Admin/index.html.twig', array(
			'alliances' => $alliances
		));
	}

	public function createAction(Request $request)
	{
		$alliance = new Alliance();

		$form = $this->createForm(new AllianceAdminType(), $alliance);
		$form->handleRequest($request);

		if($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($alliance);
			$em->flush();

			$request->getSession()->getFlashBag()->add('success', 'L\'alliance à bien été créée.');

			return $this->redirect($this->generateUrl('ccta_alliance_admin_index'));
		}

		return $this->render('@CctaAlliance/Admin/create.html.twig', array(
			'form' => $form->createView()
		));
	}

	public function editAction(Alliance $alliance, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$form = $this->createForm(new AllianceAdminType(), $alliance);
		$form->handleRequest($request);

		if($form->isValid()) {
			$em->persist($alliance);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'L\'alliance à bien été modifiée.');

			return $this->redirect($this->generateUrl('ccta_alliance_admin_index'));
		}

		return $this->render('@CctaAlliance/Admin/edit.html.twig', array(
			'form' => $form->createView(),
			'alliance' => $alliance
		));

	}

	public function deleteAction(Alliance $alliance, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$form = $this->createFormBuilder()->getForm();
		$form->handleRequest($request);

		if($form->isValid()) {
			$em->remove($alliance);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "L'alliance a bien été supprimée.");

			return $this->redirect($this->generateUrl('ccta_alliance_admin_index'));
		}

		// Si la requête est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('CctaAllianceBundle:Admin:delete.html.twig', array(
			'alliance' => $alliance,
			'form'   => $form->createView()
		));
	}

}