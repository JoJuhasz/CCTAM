<?php

namespace Ccta\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ccta\UserBundle\Entity\User;
use Ccta\UserBundle\Form\UserType;

class AdminController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('CctaUserBundle:User');

		$users = $repo->findAll();

		return $this->render('CctaUserBundle:Admin:index.html.twig', array(
			'users' => $users
		));
	}

	public function createAction(Request $request)
	{
		$user = new User();
		$form = $this->get('form.factory')->create(new UserType(), $user);

		$form->handleRequest($request);

		if($form->isValid()) {
			$um = $this->container->get('fos_user.user_manager');

			$user = $um->createUser();

			$data = $request->request->get('ccta_userbundle_user');

			$user->setUsername($data["username"]);
			$user->setEmail($data["email"]);
			$user->setPlainPassword($data["password"]);
			$user->setEnabled($data["enabled"]);

			$user->setRoles($data["roles"]);

			$um->updateUser($user, true);
			//$user->setUsername($form->getData());

			$request->getSession()->getFlashBag()->add('notice', 'User bien enregistré.');

			return $this->redirect($this->generateUrl('ccta_user_admin_index'));
		}

		return $this->render('CctaUserBundle:Admin:add.html.twig', array(
			'form' => $form->createView(),
		));
	}

	public function editAction($id, Request $request)
	{
		$um = $this->get('fos_user.user_manager');
		$user = $um->findUserBy(array('id' => $id));
		$form = $this->get('form.factory')->create(new UserType(), $user);

		$form->handleRequest($request);

		if($form->isValid()) {
			$data = $request->request->get('ccta_userbundle_user');

			$user->setUsername($data["username"]);
			$user->setEmail($data["email"]);
			$user->setPlainPassword($data["password"]);
			$user->setEnabled($data["enabled"]);

			$user->setRoles($data["roles"]);

			$um->updateUser($user, true);
			//$user->setUsername($form->getData());

			$request->getSession()->getFlashBag()->add('notice', 'User bien enregistré.');

			return $this->redirect($this->generateUrl('ccta_user_admin_index'));
		}

		return $this->render('CctaUserBundle:Admin:edit.html.twig', array(
			'form' => $form->createView(),
			'user' => $user
		));
	}

	public function deleteAction($id, Request $request)
	{

		$um = $this->get('fos_user.user_manager');
		$user = $um->findUserBy(array('id' => $id));

		if (null === $user) {
			throw new NotFoundHttpException("Cet utilisateur n'existe pas.");
		}

		$form = $this->createFormBuilder()->getForm();

		if ($form->handleRequest($request)->isValid()) {

			$um->deleteUser($user);

			$request->getSession()->getFlashBag()->add('info', "L'utilisateur a bien été supprimé.");

			return $this->redirect($this->generateUrl('ccta_user_admin_index'));
		}

		// Si la requête est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('CctaUserBundle:Admin:delete.html.twig', array(
			'user' => $user,
			'form'   => $form->createView()
		));
	}
}