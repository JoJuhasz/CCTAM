<?php

namespace Ccta\AllianceBundle\Controller;

use Ccta\AllianceBundle\Entity\Alliance;
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

			$em->persist($alliance);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'Alliance bien enregistrée.');

			return $this->redirect($this->generateUrl('ccta_core_homepage'));
		}

		return $this->render('@CctaAlliance/Game/create.html.twig', array(
			'form' => $form->createView(),
		));
	}
}