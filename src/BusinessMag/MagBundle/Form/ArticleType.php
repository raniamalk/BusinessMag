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
            /*->add ('theme',new ThemeType())*/
            ->add ('theme', 'entity', array(
                'class' => 'MagBundle:Theme',
                'property' => 'nom',
                /*'multiple' => true,*/
                'expanded' => true,
            ))

            ->add('titre', 'textarea'/*, array('attr' => array('name'=>'editor1','class' => 'ckeditor'))*/)

            ->add('fileb', 'file', array(
                'label' => 'Image en vedette',
                'required' => false ))

            ->add('texteIntro', 'textarea')

            ->add('file', 'file', array(
                'label' => 'Image intro',
                'required' => false ))

            ->add('texteArticle', 'textarea')

            ->add('filea', 'file', array(
                'label' => 'Image article',
                'required' => false ))

            ->add ('rubrique', 'entity', array(
                'class' => 'MagBundle:Rubrique',
                'property' => 'nom',
                'multiple' => true,
                'expanded' => true,))

            ->add('Valider',      'submit')

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
