<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 09/07/2018
 * Time: 11:25
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Theme;
use BusinessMag\MagBundle\Form\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ThemeController extends Controller
{

    public function addAction(Request $request){

        $theme = new Theme();
        $form = $this->createForm(new ThemeType(),$theme);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();

            return $this->redirect($this->generateUrl('theme_list'));
        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:ThemeAdd.html.twig', array('form'=>$formView));

    }

    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $theme = $repository->findAll();

        return $this->render('MagBundle:Default:ThemesList.html.twig', array('theme'=>$theme));

    }

    public function editAction(Request $request,Theme $theme)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ThemeType(),$theme);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('theme_list'));

        }


        return $this->render('MagBundle:Default:ThemeAdd.html.twig',array('form'=>$formView));


    }



    public function deleteAction(Theme $theme){

        $em = $this->getDoctrine()->getManager();
        $em->remove($theme);
        $em->flush();


        return $this->redirect($this->generateUrl('theme_list'));

    }


}