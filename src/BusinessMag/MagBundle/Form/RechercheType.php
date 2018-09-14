<?php
namespace BusinessMag\MagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormbuilderInterface $builder, array $option)
    {
        $builder->add('recherche','text');
    }
    
    public function getName()
    {
        return 'business_magbundle_recherche';
    }
}