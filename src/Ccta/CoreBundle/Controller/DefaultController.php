<?php

namespace Ccta\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CctaCoreBundle:Default:index.html.twig');
    }
}
