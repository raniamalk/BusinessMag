<?php

namespace BusinessMag\MagBundle\Form;

use BusinessMag\MagBundle\Entity\Theme;
use BusinessMag\MagBundle\Entity\Rubrique;
use BusinessMag\MagBundle\Entity\ThemeRepository;
use BusinessMag\MagBundle\MagBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add ('theme', 'entity', array(
                'class' => 'MagBundle:Theme',
                'property' => 'nom',
                'expanded' => true,
                'required'    => false,))

            ->add('file', 'file', array(
                'label' => 'Image intro',
                'required'    => false ))
            ->add('titreIntro', 'textarea', array(
                'required' => false ))

            ->add('texteIntro', 'textarea', array(
                'required' => false ))



            ->add('filea', 'file', array(
                'label' => 'Image article',
                'required' => false ))
            ->add('titreArticle', 'textarea', array(
                'required' => false ))
            ->add('texteArticle', 'textarea',array(
                'required' => false ))
            ->add ('rubrique', 'entity', array(
                'class' => 'MagBundle:Rubrique',
                'property' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false))



            ->add('titre', 'textarea', array(
                'required' => false ))
            ->add('fileb', 'file', array(
                'label' => 'Image en vedette',
                'required' => false ))



            ->add('datePub', 'date', array(
                'label' => 'Date Début',
                'input'  => 'datetime',
                'widget' => 'single_text'))

            ->add('dateFin', 'date', array(
                'label' => 'Date Fin',
                'input'  => 'datetime',
                'widget' => 'single_text',
                'required' => false))

            ->add('datePubVed', 'date', array(
                'required' => false,
                'label' => 'Date Début',
                'input'  => 'datetime',
                'widget' => 'single_text',))

            ->add('dateFinVed', 'date', array(
                'required' => false,
                'label' => 'Date Fin',
                'input'  => 'datetime',
                'widget' => 'single_text'))


            ->add('published', 'checkbox', array('required' => false, 'label'=> 'Publié'))
            ->add('vpublished', 'checkbox', array('required' => false, 'label'=> 'Publié'))


        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BusinessMag\MagBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'businessmag_magbundle_article';
    }
}


