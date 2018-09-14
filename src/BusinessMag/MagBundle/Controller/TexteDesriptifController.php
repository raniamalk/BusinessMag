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
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
class TexteDesriptifController extends Controller
{

    public function addAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


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

        return $this->render('MagBundle:Default:DescriptionAdd.html.twig', array('form'=>$formView, 'user' => $user));

    }

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:TexteDescriptif');
        $textedescriptif = $repository->findAll();

        return $this->render('MagBundle:Default:DescriptionList.html.twig', array('tdescri'=>$textedescriptif, 'user' => $user));

    }

    public function editAction(Request $request,TexteDescriptif $textedescriptif, $id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new TexteDescriptifType(),$textedescriptif);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted() && $form->isValid()){

            $em->flush();


            return $this->redirect($this->generateUrl('td_list'));

        }


        return $this->render('MagBundle:Default:DescriptionAdd.html.twig',array('form'=>$formView, 'user' => $user,  'ids'=>$id));


    }



    public function deleteAction(TexteDescriptif $textedescriptif){

        $em = $this->getDoctrine()->getManager();
        $em->remove($textedescriptif);
        $em->flush();


        return $this->redirect($this->generateUrl('td_list'));

    }


}