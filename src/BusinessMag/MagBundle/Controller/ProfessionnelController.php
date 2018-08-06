<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 10/07/2018
 * Time: 15:22
 */

namespace BusinessMag\MagBundle\Controller;
use BusinessMag\MagBundle\Entity\Professionnel;
use BusinessMag\MagBundle\Form\ProfessionnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionnelController extends Controller
{
    public function addAction(Request $request){

        $prof = new Professionnel();
        $em = $this->getDoctrine()->getManager();
        $form=$this->createForm(new ProfessionnelType(), $prof);
        $form->handleRequest($request);
        $formView = $form->createView();
        if($form ->isSubmitted()){
            $em->persist($prof);
            $em->flush();

            /*return new Response('professionnel ajouté');*/
            /*return $this->render('MagBundle:Default:Professionnel.html.twig',array('form'=>$formView));*/
            return $this->redirect($this->generateUrl('pro_add'));
        }



        return $this->render('MagBundle:Default:Professionnel.html.twig',array('form'=>$formView));


    }

    public function listAction(){


        $repository=$this->getDoctrine()->getRepository('MagBundle:Professionnel');

        $pro = $repository->findAll();

        return $this->render('MagBundle:Default:ProsList.html.twig',array('pro'=>$pro));

    }

    public function editAction(Request $request, Professionnel $professionnel)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ProfessionnelType(),$professionnel);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('pro_list'));

        }


        return $this->render('MagBundle:Default:Professionnel.html.twig',array('form'=>$formView));


    }

    public function deleteAction(Professionnel $professionnel){

        $em = $this->getDoctrine()->getManager();
        $em->remove($professionnel);
        $em->flush();


        return $this->redirect($this->generateUrl('pro_list'));

    }

}