<?php

namespace BusinessMag\MagBundle\Form;

use BusinessMag\MagBundle\MagBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class PartenairesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('partenaires')
            ->add('siteWeb')
            ->add('file', 'file', array(
                'label' => 'Logo',
                'required' => false ))
            ->add('Valider',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BusinessMag\MagBundle\Entity\Partenaires'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'businessmag_magbundle_partenaires';
    }
}
