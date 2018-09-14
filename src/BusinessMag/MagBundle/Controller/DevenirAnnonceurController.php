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
use BusinessMag\MagBundle\Form\DevenirAnnonceurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;




class DevenirAnnonceurController  extends Controller
{


    
    public function createAction(Request $request){

    $devenirAnnonceur=new DevenirAnnonceur();
    $em = $this->getDoctrine()->getManager();

    
    $form=$this->createCreateForm($devenirAnnonceur);
    $form->handleRequest($request);
    if($form->isValid() && $form->isSubmitted()){
        //$devenirAnnonceur->setCreatedAt(new \DateTime());
        $em->persist($devenirAnnonceur);
        $em->flush();
        return $this->redirect($this->generateUrl('success'));
    }
    
    $themes=$em->getRepository('MagBundle:Theme')->findAll();


    return $this->render('MagBundle:devenirAnnonceur:createAnnonceurFront.html.twig',
     array( 'themes'=>$themes,
           'form'=>$form->createView()));
  }

    /**
    * Creates a form to create a Produits entity.
    *
    * @param Produits $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(DevenirAnnonceur $devenirAnnonceur)
    {
        $form = $this->createForm(new DevenirAnnonceurType(), $devenirAnnonceur);

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    public function addAction() {


        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $themes = $repository->findAll();

        return $this->render('MagBundle:Default:DevenirAnnonceur.html.twig',array('themes'=>$themes));

    }


    public function listAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository = $this->getDoctrine()->getRepository('MagBundle:DevenirAnnonceur');
        $annonceur = $repository->findAll();


        return $this->render('MagBundle:Default:DevenirAnnonceurList.html.twig',array('annonceur'=>$annonceur, 'user' => $user));

    }



    public function deleteAction(DevenirAnnonceur $devenirannonceur){

        $em = $this->getDoctrine()->getManager();
        $em->remove($devenirannonceur);
        $em->flush();


        return $this->redirect($this->generateUrl('annonceur_list'));

    }

    public function fillAction(Request $request)
    {

        $nom     = $request->request->get('nom');
        $fonction = $request->request->get('fonction');
        $telephone   = $request->request->get('telperso');
        $email  = $request->request->get('emailperso');
        $raisonSoc  = $request->request->get('raisons');
        $site = $request->request->get('siteweb');
        $tel  = $request->request->get('telpro');
        $mail  = $request->request->get('emailpro');
        $page_acc  = $request->request->get('page_acc');
        $habillage_acc  = $request->request->get('habillage_acc');
        $banniere_acc  = $request->request->get('banniere_acc');
        $page_theme  = $request->request->get('page_theme');
        $banniere_theme  = $request->request->get('banniere_theme');
        $vignette_theme = $request->request->get('vignette_theme');
        $themes_sponsor  = $request->request->get('themes_sponsor');
        $page_articler  = $request->request->get('page_article');
        $banniere_article  = $request->request->get('banniere_article');
        $vignette_article  = $request->request->get('vignette_article');
        $themes_article  = $request->request->get('themes_article');

        $annonceur=array('nom'=>$nom,'fonction'=>$fonction,'telperso'=>$telephone,'emailperso'=>$email,'raisons'=>$raisonSoc,
            'siteweb'=>$site,'telpro'=>$tel,'emailpro'=>$mail,'page_acc'=>$page_acc,'habillage_acc'=>$habillage_acc,
            'banniere_acc'=>$banniere_acc,'page_theme'=>$page_theme,'banniere_theme'=>$banniere_theme,'vignette_theme'=>$vignette_theme,'themes_sponsor'=>$themes_sponsor,
            'page_article'=>$page_articler,'banniere_article'=>$banniere_article,'vignette_article'=>$vignette_article,'themes_article'=>$themes_article);
        $this->get('session')->set('annonceur', $annonceur);

        $result =array('annonceur' => $annonceur);



        return new Response(json_encode($result), 200);


    }

    public function saveAction(Request $request)


    {
        $em = $this->getDoctrine()->getManager();
        $date_tr = new \DateTime('now');

        $session = $this->getRequest()->getSession();

        $annonceur = $session->get('annonceur');

        $result = ($annonceur);

        $nom    = $annonceur['nom'];
        $fonction    = $annonceur['fonction'];
        $telephone    =$annonceur['telperso'];
        $email    = $annonceur['emailperso'];
        $raisonSoc    = $annonceur['raisons'];
        $site    = $annonceur['siteweb'];
        $tel    = $annonceur['telpro'];
        $mail    = $annonceur['emailpro'];
        $page_acc    =$annonceur['page_acc'];
        $habillage_acc    =$annonceur['habillage_acc'];
        $banniere_acc    = $annonceur['banniere_acc'];
        $page_theme    = $annonceur['page_theme'];
        $banniere_theme    = $annonceur['banniere_theme'];
        $vignette_theme    = $annonceur['vignette_theme'];
        $themes_sponsor    = $annonceur['themes_sponsor'];
        $page_articler    = $annonceur['page_article'];
        $banniere_article    = $annonceur['banniere_article'];
        $vignette_article    = $annonceur['vignette_article'];
        $themes_article    = $annonceur['themes_article'];


        $entity = new DevenirAnnonceur();
        $entity->setNom($nom);
        $entity->setFonction($fonction);
        $entity->setTelPerso($telephone);
        $entity->setEmailPerso($email);
        $entity->setRaisonSocial($raisonSoc);
        $entity->setSiteWeb($site);
        $entity->setTelPro($tel);
        $entity->setEmailPro($mail);
        $entity->setPageAcc($page_acc);
        $entity->setHabillageAcc($habillage_acc);
        $entity->setBanniereAcc($banniere_acc);
        $entity->setPageTheme($page_theme);
        $entity->setBanniereThe($banniere_theme);
        $entity->setVignetteThe($vignette_theme);
        $entity->setSponsTheme($themes_sponsor);
        $entity->setPageArticle($page_articler);
        $entity->setBanniereArt($banniere_article);
        $entity->setVignetteArt($vignette_article);
        $entity->setArtTheme($themes_article);

        $em->persist($entity);

        $em->flush();


        return new Response(json_encode($result), 200);


    }

    public function showAction($id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MagBundle:DevenirAnnonceur')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Cet annonceur est introuvable.');
        }
        return $this->render('MagBundle:Default:DevenirAnnonceurShow.html.twig', array(
            'entity' => $entity, 'user' => $user, 'ids'=>$id));
    }


}