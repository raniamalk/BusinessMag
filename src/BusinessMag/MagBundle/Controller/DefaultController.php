<?php

namespace BusinessMag\MagBundle\Controller;

use BusinessMag\MagBundle\Entity\DevenirPartenaire;
use BusinessMag\MagBundle\Form\DevenirPartenaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class DefaultController extends Controller
{
    public function indexAction()
    {


    	$em=$this->getDoctrine()->getManager();
        $articles=$em->getRepository('MagBundle:Article');

        //récupere les articles pour slider
        $slideArticles=$articles->slideArticles();
        //pour récupérer les 6 derniers articles
        $listArticles=$articles->listArticles();
        
        

        //afficher la liste des video
        $sql="SELECT * FROM video ";
        $sql="SELECT * FROM video order by created_at desc limit 4";
        $conn = $this->getDoctrine()->getConnection('customer');
            
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $liste_video=$stmt->fetchAll();
        

            
    	return $this->render('MagBundle:Default:index.html.twig',
               array('articles'=>$listArticles,
               	     'slideArticles'=>$slideArticles,
                   'liste_video'=>$liste_video
               	     )
        
        );
    }


    public function rechercheAction() 
    {
        $form = $this->createForm(new RechercheType());
        return $this->render('MagBundle:Default:modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }
/*    public function showUserAction()
    {
        if($this->get('security.authorization_chicker')->isGranted('ROLR_USER'))
        {return $this->render('MagBundle:Default:index.html.twig');}

    }*/
     public function successAction(){

        return $this->render('MagBundle:Default:success.html.twig');
     }
     
     public function footerAction(){
             $devenirPartenaire=new DevenirPartenaire();
    $em = $this->getDoctrine()->getManager();

    $themes=$em->getRepository('MagBundle:Theme')->findAll();
    $partenaires=$em->getRepository('MagBundle:Partenaires')->findAll();

    $textDescriptif=$em->getRepository('MagBundle:TexteDescriptif')->find(1);
     
     return $this->render('MagBundle:Default:moduleUsed/footer.html.twig',
         array('partenaires'=>$partenaires,
               'themes'=>$themes,
               'textDescriptif'=>$textDescriptif));
     }




    public function BackofficeAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        return $this->render('MagBundle:Default:Backoffice.html.twig',array('user' => $user));
    }



}


