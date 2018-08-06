<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 05/07/2018
 * Time: 15:43
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Article;
use BusinessMag\MagBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    public function addAction(Request $request)
    {
       $article= new Article();
       $article->setCreatedAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
       $form = $this->createForm(new ArticleType(),$article);

       $form->handleRequest($request);
       $formView = $form->createView();

        if($form->isSubmitted()){


            $em->persist($article);
            $em->flush();



            return $this->redirect($this->generateUrl('contenu_add'));


        }


        return $this->render('MagBundle:Default:ArticleAdd.html.twig',array('form'=>$formView));


    }

    public function listAction(){


        $repository=$this->getDoctrine()->getRepository('MagBundle:Article');

        $article = $repository->findAll();
        $repository=$this->getDoctrine()->getRepository('MagBundle:Rubrique');

        $rubrique = $repository->findAll();

        return $this->render('MagBundle:Default:ArticlesList.html.twig',array('article'=>$article, 'rubrique'=>$rubrique));

    }


    public function editAction(Request $request,Article $article,$id)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ArticleType(),$article);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('contenu_list'));


        }


        return $this->render('MagBundle:Default:ArticleEdit.html.twig',array('form'=>$formView,'ids'=>$id));


    }


    public function deleteAction(Article $article){

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();


        return $this->redirect($this->generateUrl('contenu_list'));

    }



}