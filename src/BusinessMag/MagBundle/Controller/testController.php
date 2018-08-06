<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 24/07/2018
 * Time: 09:38
 */

namespace BusinessMag\MagBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class testController extends Controller
{


    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:DevenirAnnonceur');
        $ann = $repository->findAll();

        return $this->render('MagBundle:Default:form_List.html.twig', array('annonceur'=>$ann));

    }

}