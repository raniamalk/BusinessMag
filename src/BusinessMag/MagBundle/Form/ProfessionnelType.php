<?php

namespace BusinessMag\MagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfessionnelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('raisonSocial', 'text',array('required'=> false))
            ->add('codeFirm', 'text',array('required'=> false))
            ->add('file', 'file', array('label' => 'Logo', 'required' => false ))
            ->add('telephone', 'text',array('required'=> false))
            ->add('adresse', 'text',array('required'=> false))
            ->add('lien', 'text',array('required'=> false))
            ->add('published', 'checkbox', array('label'=>'Publié', 'required'=> false))
            ->add('dateDebut', 'date', array('label' => 'Date Début', 'input'  => 'datetime', 'widget' => 'single_text'))
            ->add('dateFin', 'date', array('label' => 'Date Fin', 'input'  => 'datetime', 'widget' => 'single_text'))
            ->add('Valider',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BusinessMag\MagBundle\Entity\Professionnel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'businessmag_magbundle_professionnel';
    }
}
