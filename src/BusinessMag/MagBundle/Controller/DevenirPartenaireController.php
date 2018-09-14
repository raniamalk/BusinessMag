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




class DevenirPartenaireController  extends Controller
{

    public function addAction(Request $request)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $devPart= new DevenirPartenaire();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new DevenirPartenaireType(),$devPart);

        $form->handleRequest($request);
        $formView = $form->createView();

        if($form->isSubmitted() && $form->isValid()){


            $em->persist($devPart);
            $em->flush();



            return $this->redirect($this->generateUrl('devenirpartenaire_list'));


        }


        return $this->render('MagBundle:Default:DevenirPartenaire.html.twig',array('form'=>$formView, 'user' => $user));


    }

    public function listAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:DevenirPartenaire');
        $partenaire = $repository->findAll();



        return $this->render('MagBundle:Default:DevenirPartenaireList.html.twig',array('partenaire'=>$partenaire, 'user' => $user));

    }



    public function deleteAction(DevenirPartenaire $devenirpartenaire){

        $em = $this->getDoctrine()->getManager();
        $em->remove($devenirpartenaire);
        $em->flush();


        return $this->redirect($this->generateUrl('devenirpartenaire_list'));

    }

 public function createAction(Request $request){

    $devenirPartenaire=new DevenirPartenaire();
    $em=$this->getDoctrine()->getManager();
    $form=$this->createCreateForm($devenirPartenaire);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        
     $em->persist($devenirPartenaire);
     $em->flush();

        $request->getSession()
                ->getFlashBag()
                ->add('success', 'Ajout avec success');
    
     return $this->redirect($this->generateUrl('success'));
    }
    return $this->render('MagBundle:devenirPartenaire:createPartenaireFront.html.twig',
     array('form'=>$form->createView()));
    }
  
  public function createCreateForm(DevenirPartenaire $devenirPartenaire){
       $form=$this->createForm(new DevenirPartenaireType(),$devenirPartenaire);
      // $form->add('submit'=>'submit',array('label'=>'create'));
       return $form;

    }

    public function showAction($id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MagBundle:DevenirPartenaire')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Ce partenaire est introuvable.');
        }
        return $this->render('MagBundle:Default:DevenirPartenaireShow.html.twig', array(
            'entity' => $entity, 'user' => $user));
    }

}
