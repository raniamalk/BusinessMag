<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 27/07/2018
 * Time: 10:22
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Habillage;
use BusinessMag\MagBundle\Form\HabillageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HabillageController extends Controller
{


    public function testAction(Request $request){


        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $themes = $repository->findAll();
        if($request->isMethod('post')) {


            $habillage = new Habillage();
            $em        = $this->getDoctrine()->getManager();
            $theme     = $request->request->get('theme');
            $entities  = $em->getRepository('MagBundle:Theme')->find($theme);
            $file      =   $request->request->get('filec');
            $opt       =   $request->request->get('optradio');
            $lien      =   $request->request->get('lien');
//  $entity= $em->getRepository('MagBundle:Habillage')->find($id);
            $habillage->setPathc($file);
            $habillage->setLien($lien);
            $habillage->setTheme($entities);
            $habillage->setPathc($file);
            $habillage->setType($opt);

            $em->persist($habillage);
            $em->flush();

            return $this->redirect($this->generateUrl('habillage_add_test'));

        }

        return $this->render('MagBundle:Default:HabillageAdd.html.twig',array('themes'=>$themes));
    }






    /*public function AddAction(Request $request){

        $habillage=new Habillage();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new HabillageType(), $habillage);
        $form->handleRequest($request);
        $formView = $form->createView();
        if($form->isSubmitted()){
            $em->persist($habillage);
            $em->flush();

            return $this->redirect($this->generateUrl('habillage_add'));
        }
        return $this->render('MagBundle:Default:HabillageAdd.html.twig',array('form'=>$formView));
    }*/


    public function ListAction(){

        $repository=$this->getDoctrine()->getRepository('MagBundle:Habillage');
        $habillage=$repository->findAll();

        return $this->render('MagBundle:Default:HabillageList.html.twig',array('habillage'=>$habillage));

    }



    /*public function editAction(Request $request,Habillage $habillage,$id)
    {


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new HabillageType(),$habillage);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('habillage_list'));


        }


        return $this->render('MagBundle:Default:HabillageEdit.html.twig',array('form'=>$formView,'ids'=>$id));


    }*/







    public function deleteAction(Habillage $habillage){

        $em = $this->getDoctrine()->getManager();
        $em->remove($habillage);
        $em->flush();


        return $this->redirect($this->generateUrl('habillage_list'));

    }





}