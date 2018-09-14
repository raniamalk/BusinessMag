<?php

namespace BusinessMag\MagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PublierArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('nom', 'text' ,array(
                'required' => false))
            ->add('fonction', 'text',array(
                'required' => false))
            ->add('telPerso', 'text',array(
                'required' => false))
            ->add('emailPerso', 'text',array(
                'required' => false))
            ->add('raisonSocial', 'text',array(
                'required' => false))
            ->add('siteWeb', 'text',array(
                'required' => false))
            ->add('telPro', 'text',array(
                'required' => false))
            ->add('emailPro', 'text',array(
                'required' => false))
            ->add('article','textarea',array(
                'required' => false))
            ->add ('theme', 'entity', array(
                'class' => 'MagBundle:Theme',
                'property' => 'nom',
                'expanded' => true, ))
            ->add('Valider', 'submit');*/
              ->add('nom', 'text')
            ->add('fonction', 'text')
            ->add('telPerso', 'text')
            ->add('emailPerso', 'email')
            ->add('raisonSocial', 'text')
            ->add('siteWeb', 'text')
            ->add('telPro', 'text')
            ->add('emailPro', 'email')
            ->add('article','textarea')
            ->add ('theme', 'entity', array(
                'class' => 'MagBundle:Theme',
                'property' => 'nom',
                'expanded' => true, ))
            //->add('Valider', 'submit')
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BusinessMag\MagBundle\Entity\PublierArticle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'businessmag_magbundle_publierarticle';
    }
}
