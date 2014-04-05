<?php

namespace Manager\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpecType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('article',null,array(
                'attr' => array('class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Manager\CommercialBundle\Entity\Spec'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'manager_commercialbundle_spec';
    }
}
