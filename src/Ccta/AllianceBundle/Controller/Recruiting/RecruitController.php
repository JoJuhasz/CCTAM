<?php

namespace Ccta\AllianceBundle\Controller\Recruiting;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RecruitController extends Controller
{

	public function recruitersAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$player = $em->getRepository('CctaPlayerBundle:Player')->find($request->getSession()->get('activePlayer')->getId());
		$world  = $em->getRepository('CctaWorldBundle:World')->find($request->getSession()->get('activeWorld')->getId());



	}

	public function applyAction($allianceId, Request $request)
	{
		die('ok'.$allianceId);
	}
}