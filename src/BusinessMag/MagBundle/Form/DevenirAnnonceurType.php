<?php

namespace BusinessMag\MagBundle\Form;

use Symfony\Component\Form\AbstractType;
use BusinessMag\MagBundle\Entity\Theme;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DevenirAnnonceurType extends AbstractType{

	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $option){
        $builder->add('nom')
                ->add('fonction')
                ->add('telPerso')
                ->add('emailPerso','email')
                ->add('raisonSocial')
                ->add('siteWeb')
                ->add('telPro')
                ->add('emailPro','email')
                ->add('pageAcc','checkbox')
                ->add('habillageAcc','checkbox')
                ->add('banniereAcc','checkbox')
                ->add('pageTheme','checkbox')
                ->add('banniereThe','checkbox')
                ->add('vignetteThe','checkbox')
                ->add('sponsTheme','checkbox')
                ->add('pageArticle','checkbox')
                ->add('banniereArt','checkbox')
                ->add('vignetteArt','checkbox')
               /*->add ('theme', 'entity', array(
                'class' => 'MagBundle:Theme',
                'property' => 'nom',
                'expanded' => true, ))*/
                ->add('artTheme','checkbox');
    	
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BusinessMag\MagBundle\Entity\DevenirAnnonceur'
        ));
    }

      /**
     * @return string
     */
    public function getName()
    {
        return 'businessmag_magbundle_devenir_annonceur';
    }
}