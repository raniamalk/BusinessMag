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

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PartenairesController extends Controller
{

    public function addAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $partenaire = new Partenaires();
        $form = $this->createForm(new PartenairesType(),$partenaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $Image = $this->getRequest()->get('fname');


            $em->persist($partenaire);
            $em->flush();

            if ($Image==3){
                return $this->redirect($this->generateUrl('partenaires_list'));
            }
            else{

                return $this->redirect($this->generateUrl('partenaires_add'));
            }

        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:PartenairesAdd.html.twig', array('form'=>$formView, 'user' => $user));

    }

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:Partenaires');
        $partenaire = $repository->findAll();

        return $this->render('MagBundle:Default:PartenairesList.html.twig', array('part'=>$partenaire, 'user' => $user));

    }

    public function editAction(Request $request,Partenaires $partenaire,$id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $partenaire->setUpdateddAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PartenairesType(),$partenaire);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('partenaires_list'));

        }


        return $this->render('MagBundle:Default:PartenairesEdit.html.twig',array('form'=>$formView,'ids'=>$id, 'part'=>$partenaire, 'user' => $user));


    }



    public function deleteAction(Partenaires $partenaire){

        $em = $this->getDoctrine()->getManager();
        $em->remove($partenaire);
        $em->flush();


        return $this->redirect($this->generateUrl('partenaires_list'));

    }


}