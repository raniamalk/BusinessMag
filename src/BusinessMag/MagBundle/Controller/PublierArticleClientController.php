<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 19/07/2018
 * Time: 09:35
 */

namespace BusinessMag\MagBundle\Controller;

use BusinessMag\MagBundle\Entity\Commentaire;
use BusinessMag\MagBundle\Entity\DevenirPartenaire;
use BusinessMag\MagBundle\Entity\DevenirAnnonceur;
use BusinessMag\MagBundle\Entity\Article;
use BusinessMag\MagBundle\Form\PublierArticleType;
use BusinessMag\MagBundle\Entity\PublierArticle;
use BusinessMag\MagBundle\Form\ArticleType;
use BusinessMag\MagBundle\Form\CommentaireType;
use BusinessMag\MagBundle\Form\DevenirPartenaireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;




class PublierArticleClientController  extends Controller
{

    public function listAction(Request $request){



        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:PublierArticle');
        $published = $repository->findAll();



        return $this->render('MagBundle:Default:PublierArticleList.html.twig',array( 'pub'=>$published, 'user' => $user));

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

        $em = $this->getDoctrine()->getManager();
        $em->remove($publierarticle);
        $em->flush();


        return $this->redirect($this->generateUrl('publierarticle_list'));

    }

}