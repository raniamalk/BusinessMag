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




class LaisserCommentaireController  extends Controller
{



    public function listAction(Request $request){


        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:Commentaire');
        $comment = $repository->findAll();

        return $this->render('MagBundle:Default:LaisserCommentaireList.html.twig',array('comment'=>$comment, 'user' => $user));

    }


    public function deleteAction(Commentaire $commentaire){

        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaire);

        $em->flush();


        return $this->redirect($this->generateUrl('laissercomment_list'));

    }

    public function showAction($id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MagBundle:Commentaire')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Ce commentaire est introuvable.');
        }
        return $this->render('MagBundle:Default:LaisserCommentaireShow.html.twig', array(
            'entity' => $entity, 'user' => $user, 'id' => $id));
    }

}