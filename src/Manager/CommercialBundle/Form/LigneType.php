<?php

namespace Manager\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article',null,array(
                'attr' => array('class' => 'form-control')))
            ->add('qte','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('remise','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('puht','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('tva','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('puttc','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('totalttc','text',array(
                'attr' => array('class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Manager\CommercialBundle\Entity\Ligne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'manager_commercialbundle_ligne';
    }
}
