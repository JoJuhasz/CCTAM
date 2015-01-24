<?php

namespace Ccta\UserBundle\Controller;

use Ccta\UserBundle\Entity\User;
use Ccta\UserBundle\Form\ProfileFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	public function indexAction()
	{
		$repo = $this->getDoctrine()->getRepository('CctaUserBundle:User');
		$users = $repo->findAll();

		return $this->render('@CctaUser/Admin/index.html.twig', array(
			'users' => $users
		));
	}

	public function createAction(Request $request)
	{

	}

	public function editAction(User $user, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		//var_dump($user); die();

		$form = $this->createForm(new ProfileFormType('\\Ccta\\UserBundle\\Entity\\User'), $user);
		$form->handleRequest($request);

		if($form->isValid()) {
			$em->persist($user);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', 'User à bien été modifié.');

			return $this->redirect($this->generateUrl('ccta_user_admin_index'));
		}

		return $this->render('@CctaUser/Admin/edit.html.twig', array(
			'form' => $form->createView(),
			'user' => $user
		));
	}

	public function deleteAction(User $user, Request $request)
	{

	}
}