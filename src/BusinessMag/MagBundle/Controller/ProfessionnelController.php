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

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfessionnelController extends Controller
{
    public function addAction(Request $request){


        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $prof = new Professionnel();
        $prof->setCreatedAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $form=$this->createForm(new ProfessionnelType(), $prof);
        $form->handleRequest($request);
        $formView = $form->createView();
        if($form ->isSubmitted() && $form->isValid()){
            $Image = $this->getRequest()->get('fname');

            $em->persist($prof);
            $em->flush();

            if ($Image==3){
                return $this->redirect($this->generateUrl('pro_list'));
            }
            else{

                return $this->redirect($this->generateUrl('pro_add'));
            }


        }



        return $this->render('MagBundle:Default:Professionnel.html.twig',array('form'=>$formView, 'user' => $user));


    }

    public function listAction(){


        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository=$this->getDoctrine()->getRepository('MagBundle:Professionnel');

        $pro = $repository->findAll();

        return $this->render('MagBundle:Default:ProsList.html.twig',array('pro'=>$pro, 'user' => $user));

    }

    public function editAction(Request $request, Professionnel $professionnel, $id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $professionnel->setUpdateddAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ProfessionnelType(),$professionnel);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted() && $form->isValid()){

            $em->flush();


            return $this->redirect($this->generateUrl('pro_list'));

        }


        return $this->render('MagBundle:Default:ProfessionnelEdit.html.twig',array('form'=>$formView, 'user' => $user, 'id'=>$id));


    }

    public function deleteAction(Professionnel $professionnel){

        $em = $this->getDoctrine()->getManager();
        $em->remove($professionnel);
        $em->flush();

        return $this->redirect($this->generateUrl('pro_list'));

    }

}