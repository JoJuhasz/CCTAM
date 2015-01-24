<?php

namespace Ccta\PlayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playername', 'text')
            ->add('intro', 'text')
            ->add('description', 'textarea')
            ->add('avatarFile', 'file')
	        ->add('user', 'entity', array(
		        'class' => 'CctaUserBundle:User',
		        'property' => 'username'
	        ))
	        ->add('worlds', 'entity', array(
		        'class' => 'CctaWorldBundle:World',
		        'property' => 'name',
		        'multiple' => 'true',
		        'required' => false
	        ))
	        ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ccta\PlayerBundle\Entity\Player'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ccta_playerbundle_player';
    }
}
