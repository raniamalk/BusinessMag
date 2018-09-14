<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 09/07/2018
 * Time: 11:25
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Theme;
use BusinessMag\MagBundle\Form\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ThemeController extends Controller
{

    public function addAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $theme = new Theme();
        $form = $this->createForm(new ThemeType(),$theme);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $Image = $this->getRequest()->get('fname');

            $em = $this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();

            if ($Image==3){
                return $this->redirect($this->generateUrl('theme_list'));
            }
            else{

                return $this->redirect($this->generateUrl('theme_add'));
            }

        }

        $formView=$form->createView();

        return $this->render('MagBundle:Default:ThemeAdd.html.twig', array('form'=>$formView, 'user' => $user));

    }

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $theme = $repository->findAll();

        return $this->render('MagBundle:Default:ThemesList.html.twig', array('theme'=>$theme, 'user' => $user));

    }

    public function editAction(Request $request,Theme $theme,$id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ThemeType(),$theme);

        $form->handleRequest($request);
        $formView = $form->createView();


        if($form->isSubmitted()){

            $em->flush();


            return $this->redirect($this->generateUrl('theme_list'));

        }


        return $this->render('MagBundle:Default:ThemeEdit.html.twig',array('form'=>$formView,'ids'=>$id, 'user' => $user));


    }



    public function deleteAction(Theme $theme){

        $em = $this->getDoctrine()->getManager();
        $em->remove($theme);
        $em->flush();


        return $this->redirect($this->generateUrl('theme_list'));

    }

    public function deleteFormAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MagBundle:Theme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Produits entity.');
            }

            $em->remove($entity);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('success','Thème supprimé avec succès.');
        return $this->redirect($this->generateUrl('theme_list'));
    }


    /**
     * Creates a form to delete a Produits entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('themeForm_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }



}