<?php

namespace Ccta\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('username',   'text')
			->add('email',          'text')
			->add('enabled',        'checkbox')
			->add('password',       'password')
			->add('roles',          'choice',   array(
				'choices' => array(
					'ROLE_PLAYER'       => "Joueur",
					'ROLE_ADMIN'        => "Administrateur",
				),
				'multiple' => true,
				'empty_value' => 'Choisir le role',
			))
			->add('save',           'submit');
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Ccta\UserBundle\Entity\User'
		));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'ccta_userbundle_user';
	}
}
