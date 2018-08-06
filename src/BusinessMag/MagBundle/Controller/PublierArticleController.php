<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 18/07/2018
 * Time: 14:35
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\PublierArticle;
use BusinessMag\MagBundle\Form\PublierArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PublierArticleController extends Controller
{

    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:PublierArticle');
        $published = $repository->findAll();
        return $this->render('MagBundle:Default:PublishedArtList.html.twig',array('pub'=>$published));

    }



    public function editAction(Request $request,PublierArticle $publierarticle,$id){


        $em=$this->getDoctrine()->getManager();
        $form = $this->createForm(new PublierArticleType(),$publierarticle);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('published_list'));


        }


        return $this->render('MagBundle:Default:PublishedArtEdit.html.twig',array('form'=>$formView,'ids'=>$id));

    }


    public function deleteAction(PublierArticle $publierarticle){

        $em=$this->getDoctrine()->getManager();
        $em->remove($publierarticle);
        $em->flush();

        return $this->redirect($this->generateUrl('published_list'));

    }



}