<?php

namespace Ccta\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CctaUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
