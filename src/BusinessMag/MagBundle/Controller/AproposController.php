<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 25/07/2018
 * Time: 10:50
 */

namespace BusinessMag\MagBundle\Controller;

use BusinessMag\MagBundle\Entity\Apropos;
use BusinessMag\MagBundle\Form\AproposType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AproposController extends Controller
{

    public function addAction(Request $request){

        $apropos = new Apropos();
        $form = $this->createForm(new AproposType(),$apropos);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($apropos);
            $em->flush();

            return $this->redirect($this->generateUrl('apropos_list'));
        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:AproposAdd.html.twig', array('form'=>$formView));

    }

    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:Apropos');
        $apropos = $repository->findAll();

        return $this->render('MagBundle:Default:AproposList.html.twig', array('apropos'=>$apropos));

    }

    public function editAction(Request $request,Apropos $apropos,$id)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new AproposType(),$apropos);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('apropos_list'));

        }


        return $this->render('MagBundle:Default:AproposEdit.html.twig',array('form'=>$formView,'ids'=>$id));


    }




    public function deleteAction(Apropos $apropos){

        $em = $this->getDoctrine()->getManager();
        $em->remove($apropos);
        $em->flush();


        return $this->redirect($this->generateUrl('apropos_list'));

    }


}