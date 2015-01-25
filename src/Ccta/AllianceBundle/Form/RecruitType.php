<?php

namespace Ccta\AllianceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecruitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
	        ->add('save', 'submit', array(
		        'label' => 'Envoyer ma candidature',
		        'attr' => array(
			        'class' => 'btn btn-block btn-success'
		        )
	        ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ccta\AllianceBundle\Entity\Recruit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ccta_alliancebundle_recruit';
    }
}
