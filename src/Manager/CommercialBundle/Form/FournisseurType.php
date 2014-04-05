<?php

namespace Manager\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FournisseurType extends AbstractType
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
            ->add('paye','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('email','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('website','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('tel','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('fax','text',array(
                'attr' => array('class' => 'form-control')))
            ->add('file','file',array(
                'attr' => array('class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Manager\CommercialBundle\Entity\Fournisseur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'manager_commercialbundle_fournisseur';
    }
}
