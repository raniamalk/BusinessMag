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
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class AproposController extends Controller
{

    public function addAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $apropos = new Apropos();
        $form = $this->createForm(new AproposType(),$apropos);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $Image = $this->getRequest()->get('fname');

            $em->persist($apropos);
            $em->flush();

            if ($Image==3){
                return $this->redirect($this->generateUrl('apropos_list'));
            }
            else{

                return $this->redirect($this->generateUrl('apropos_add'));
            }


        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:AproposAdd.html.twig', array('form'=>$formView, 'user' => $user));

    }

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:Apropos');
        $apropos = $repository->findAll();

        return $this->render('MagBundle:Default:AproposList.html.twig', array('apropos'=>$apropos, 'user' => $user));

    }

    public function editAction(Request $request,Apropos $apropos,$id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new AproposType(),$apropos);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('apropos_list'));

        }


        return $this->render('MagBundle:Default:AproposEdit.html.twig',array('form'=>$formView,'ids'=>$id, 'user' => $user));


    }


    public function deleteAction(Apropos $apropos){

        $em = $this->getDoctrine()->getManager();
        $em->remove($apropos);
        $em->flush();

        return $this->redirect($this->generateUrl('apropos_list'));

    }

}