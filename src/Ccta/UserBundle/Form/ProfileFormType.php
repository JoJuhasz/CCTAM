<?php

namespace Ccta\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{

		parent::buildForm($builder, $options);

		// add your custom field
		$builder->add('avatarFile', 'file');

	}

	public function getName()
	{
		return 'ccta_user_profile';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Ccta\UserBundle\Entity\User',
		);
	}
}