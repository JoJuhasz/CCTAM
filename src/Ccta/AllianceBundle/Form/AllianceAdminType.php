<?php

namespace Ccta\AllianceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AllianceAdminType extends AllianceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);

        $builder->add('world', 'entity', array(
		    'class' => 'CctaWorldBundle:World',
		    'property' => 'name'
	    ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ccta\AllianceBundle\Entity\Alliance'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ccta_alliancebundle_alliance_admin';
    }
}
