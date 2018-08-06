<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 25/07/2018
 * Time: 09:38
 */

namespace BusinessMag\MagBundle\Controller;
use BusinessMag\MagBundle\Entity\TexteDescriptif;
use BusinessMag\MagBundle\Form\TexteDescriptifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TexteDesriptifController extends Controller
{

    public function addAction(Request $request){

        $textedescriptif = new TexteDescriptif();
        $form = $this->createForm(new TexteDescriptifType(),$textedescriptif);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($textedescriptif);
            $em->flush();

            return $this->redirect($this->generateUrl('td_list'));
        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:DescriptionAdd.html.twig', array('form'=>$formView));

    }

    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:TexteDescriptif');
        $textedescriptif = $repository->findAll();

        return $this->render('MagBundle:Default:DescriptionList.html.twig', array('tdescri'=>$textedescriptif));

    }

    public function editAction(Request $request,TexteDescriptif $textedescriptif)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new TexteDescriptifType(),$textedescriptif);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('td_list'));

        }


        return $this->render('MagBundle:Default:DescriptionAdd.html.twig',array('form'=>$formView));


    }



    public function deleteAction(TexteDescriptif $textedescriptif){

        $em = $this->getDoctrine()->getManager();
        $em->remove($textedescriptif);
        $em->flush();


        return $this->redirect($this->generateUrl('td_list'));

    }


}