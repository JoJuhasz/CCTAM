<?php

namespace Ccta\AllianceBundle\Controller;

use Ccta\AllianceBundle\Entity\Alliance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class ManageController extends Controller
{
	public function indexAction(Request $request)
	{

		if(!$this->get('security.authorization_checker')->isGranted('manage', new Alliance())) {
			throw new AccessDeniedException('Unauthorised access!');
		}

		return $this->render('@CctaAlliance/Manage/index.html.twig');
	}
}