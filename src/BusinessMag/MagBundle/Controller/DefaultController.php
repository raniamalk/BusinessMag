<?php

namespace BusinessMag\MagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MagBundle:Default:index.html.twig');
    }
/*    public function showUserAction()
    {
        if($this->get('security.authorization_chicker')->isGranted('ROLR_USER'))
        {return $this->render('MagBundle:Default:index.html.twig');}

    }*/

}


