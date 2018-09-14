<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 10/07/2018
 * Time: 14:09
 */

namespace BusinessMag\MagBundle\Controller;
use BusinessMag\MagBundle\Entity\DevenirPartenaire;
use BusinessMag\MagBundle\Entity\Rubrique;
use BusinessMag\MagBundle\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RubriqueController extends Controller
{

    public function testAction(Request $request,$id){



        $em = $this->getDoctrine()->getManager();
        $entity= $em->getRepository('MagBundle:DevenirPartenaire')->find($id);
        if($request->isMethod('post')) {
            /*$entity= $em->getRepository('MagBundle:DevenirPartenaire')->find($id)*/;

            $var=   $request->request->get('optradio');
            echo $var;
            die('ici var');

            $entity->setRaisonSocial($var);
            $em->persist($entity);
            $em->flush();

            die('ici n');
        }
        return $this->render('MagBundle:Default:test.html.twig',array('id'=>$id,'entity'=>$entity));
    }

    public function AddAction(Request $request){


        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $rubrique = new Rubrique();
        $form = $this->createForm(new RubriqueType(),$rubrique);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($rubrique);
            $em->flush();


            return $this->redirect($this->generateUrl('rubrique_list'));

        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:RubriqueAdd.html.twig', array('form'=>$formView, 'user' => $user));

    }

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:Rubrique');
        $rubrique = $repository->findAll();

        return $this->render('MagBundle:Default:RubriquesList.html.twig', array('rubrique'=>$rubrique, 'user' => $user));

    }


    public function editAction(Request $request,Rubrique $rubrique)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new RubriqueType(),$rubrique);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('rubrique_list'));

        }


        return $this->render('MagBundle:Default:RubriqueAdd.html.twig',array('form'=>$formView, 'user' => $user));


    }


    public function deleteAction(Rubrique $rubrique){

        $em = $this->getDoctrine()->getManager();
        $em->remove($rubrique);
        $em->flush();


        return $this->redirect($this->generateUrl('rubrique_list'));

    }



}











