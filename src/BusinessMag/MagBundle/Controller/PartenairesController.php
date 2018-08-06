<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 24/07/2018
 * Time: 15:34
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Partenaires;
use BusinessMag\MagBundle\Form\PartenairesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PartenairesController extends Controller
{

    public function addAction(Request $request){

        $partenaire = new Partenaires();
        $form = $this->createForm(new PartenairesType(),$partenaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($partenaire);
            $em->flush();

            return $this->redirect($this->generateUrl('partenaires_list'));
        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:PartenairesAdd.html.twig', array('form'=>$formView));

    }

    public function listAction(){

        $repository = $this->getDoctrine()->getRepository('MagBundle:Partenaires');
        $partenaire = $repository->findAll();

        return $this->render('MagBundle:Default:PartenairesList.html.twig', array('part'=>$partenaire));

    }

    public function editAction(Request $request,Partenaires $partenaire)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PartenairesType(),$partenaire);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('partenaires_list'));

        }


        return $this->render('MagBundle:Default:PartenairesAdd.html.twig',array('form'=>$formView));


    }



    public function deleteAction(Partenaires $partenaire){

        $em = $this->getDoctrine()->getManager();
        $em->remove($partenaire);
        $em->flush();


        return $this->redirect($this->generateUrl('partenaires_list'));

    }


}