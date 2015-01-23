<?php

namespace Ccta\AllianceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageController extends Controller
{
	public function indexAction(Request $request)
	{
		return $this->render('@CctaAlliance/Manage/index.html.twig');
	}
}