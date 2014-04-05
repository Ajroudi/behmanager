<?php

namespace Manager\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OffreType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('client',null,array(
                'attr' => array('class' => 'form-control')))
                
            //->add('user',null,array(
              //  'attr' => array('class' => 'form-control')))
                
            ->add('totalttc','text',array(
                'attr' => array('class' => 'form-control')))
           // ->add('timbre','text',array(
               // 'attr' => array('class' => 'form-control')))
            ->add('lignes','collection',array('type'=>new LigneType(),
                                             'prototype'=> true,
                                             'allow_add'=> true,
                                             'by_reference' => false))
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'input'  => 'datetime',
                'format' => 'dd/MM/yyyy',
                'attr' => array ('class' => 'date && form-control'),
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Manager\CommercialBundle\Entity\Offre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'manager_commercialbundle_offre';
    }
}
