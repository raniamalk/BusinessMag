<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 18/07/2018
 * Time: 14:35
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\PublierArticle;
use BusinessMag\MagBundle\Form\PublierArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PublierArticleController extends Controller
{

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:PublierArticle');
        $published = $repository->findAll();
        return $this->render('MagBundle:Default:PublishedArtList.html.twig',array('pub'=>$published, 'user' => $user));

    }



    public function editAction(Request $request,PublierArticle $publierarticle,$id){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $form = $this->createForm(new PublierArticleType(),$publierarticle);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted() && $form->isValid()){

            $em->flush();

            return $this->redirect($this->generateUrl('publierarticle_list'));


        }


        return $this->render('MagBundle:Default:PublierArticleEdit.html.twig',array('form'=>$formView,'ids'=>$id, 'user' => $user));

    }


    public function deleteAction(PublierArticle $publierarticle){

        $em=$this->getDoctrine()->getManager();
        $em->remove($publierarticle);
        $em->flush();

        return $this->redirect($this->generateUrl('publierarticle_list'));

    }
    
     public function publierAction(Request $request){
        $em = $this->getDoctrine()->getManager();

    
      $pubarticle= new PublierArticle();
      // $article->setCreatedAt(new \DateTime('now'));
      
       $form = $this->createForm(new PublierArticleType(),$pubarticle);

       $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){

            $em->persist($pubarticle);
            $em->flush();
        
        $request->getSession()->getFlashBag()->add('success','Votre article est publié !');
        return $this->redirect($this->generateUrl('success'));
         }

        return $this->render('MagBundle:PublierArticle:publierArticleFront.html.twig',
              array('form'=>$form->createView()                 
                   ));
    }




}