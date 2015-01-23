<?php

namespace Ccta\MessageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CctaMessageBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSMessageBundle';
	}
}
