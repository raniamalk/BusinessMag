<?php
/**
 * Created by PhpStorm.
 * User: r.malk
 * Date: 27/07/2018
 * Time: 10:22
 */

namespace BusinessMag\MagBundle\Controller;


use BusinessMag\MagBundle\Entity\Habillage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



class HabillageController extends Controller
{
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    public function AddAction(Request $request){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $themes = $repository->findAll();
        if($request->isMethod('post')) {
            $Image = $request->files->get('file');

            $picName = $this->generateUniqueFileName().'-'.$Image->getClientOriginalName();
            $dir = __DIR__.'/../../../../web/upload';

            $habillage = new Habillage();
            $em        = $this->getDoctrine()->getManager();
            $theme     = $request->request->get('theme');
            $entities  = $em->getRepository('MagBundle:Theme')->find($theme);
            $file      =   $request->request->get('file');
            $opt       =   $request->request->get('optradio');
            $lien      =   $request->request->get('lien');
            $rS     =   $request->request->get('raisonSocial');
            $cF     =   $request->request->get('codeFirm');
            $published     =   $request->request->get('etatPub');
            $dateD     =   $request->request->get('dateDebut');
            $dateF     =   $request->request->get('dateFin');
            $ajout = $this->getRequest()->get('fname');

            /*var_dump($rS);
            die('');*/

            $Image->move($dir, $picName);

//  $entity= $em->getRepository('MagBundle:Habillage')->find($id);


            $habillage->setLien($lien);
            $habillage->setRaisonSocial($rS);
            $habillage->setCodeFirm($cF);
            $habillage->setPublished($published);
            $habillage->setTheme($entities);
            $habillage->setPathc($picName);
            $habillage->setType($opt);
            $habillage->setCreatedAt(new \DateTime());
            $habillage->setDateDebut(new \DateTime($dateD));
            $habillage->setDateFin(new \DateTime($dateF));


            $em->persist($habillage);
            $em->flush();

            if ($ajout==3){
                return $this->redirect($this->generateUrl('habillage_list'));
            }
            else{

                return $this->redirect($this->generateUrl('habillage_add'));
            }

        }

        return $this->render('MagBundle:Default:HabillageAdd.html.twig',array('themes'=>$themes, 'user' => $user));
    }



    public function ListAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $repository=$this->getDoctrine()->getRepository('MagBundle:Habillage');
        $habillage=$repository->findAll();

        return $this->render('MagBundle:Default:HabillageList.html.twig',array('habillage'=>$habillage, 'user' => $user));

    }


    public function editAction(Request $request,$id)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $repository = $this->getDoctrine()->getRepository('MagBundle:Theme');
        $themes = $repository->findAll();
        $em = $this->getDoctrine()->getManager();
        $entity= $em->getRepository('MagBundle:Habillage')->find($id);

        /*echo $test;
        die('here');*/

        /*            $entity->getType();
                    var_dump($entity);
                    die(' stop');*/

        if($request->isMethod('post')) {

            $Image = $request->files->get('file');
            $test = $entity->getPathc();

//            if(!empty($entity->getPathc())/* !== null*/) {
            if (!empty($Image)/* !== null*/) {
                /*if($test instanceof UploadedFile) {*/
//                //Type hint
//                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $newImage*/
                $picName = $this->generateUniqueFileName() . '-' . $Image->getClientOriginalName();
                $dir = __DIR__ . '/../../../../web/upload';
                $file = $request->request->get('file');
                $Image->move($dir, $picName);


                $o = $request->request->get('optradio');
                $l = $request->request->get('lien');
                $rS     =   $request->request->get('raisonSocial');
                $cF     =   $request->request->get('codeFirm');
                $published     =   $request->request->get('etatPub');
                $da     =   $request->request->get('dateDebut');
                $fa     =   $request->request->get('dateFin');
                $t = $request->request->get('theme');
                $entities = $em->getRepository('MagBundle:Theme')->find($t);
                $entity->setTheme($entities);
                $entity->setType($o);
                $entity->setLien($l);
                $entity->setRaisonSocial($rS);
                $entity->setCodeFirm($cF);
                $entity->setPublished($published);
                $entity->setDateDebut(new \DateTime($da));
                $entity->setDateFin(new \DateTime($fa));
                $entity->setPathc($picName);

            } else {

                $entity->setPathc($test);
                /*$dir = __DIR__ . '/../../../../web/upload';
                $Image->move($dir, $test);*/
                $o = $request->request->get('optradio');
                $l = $request->request->get('lien');
                $rS     =   $request->request->get('raisonSocial');
                $cF     =   $request->request->get('codeFirm');
                $published     =   $request->request->get('etatPub');

                $da     =   $request->request->get('dateDebut');
                $fa     =   $request->request->get('dateFin');
                $t = $request->request->get('theme');
                $entities = $em->getRepository('MagBundle:Theme')->find($t);
                $entity->setTheme($entities);
                $entity->setType($o);
                $entity->setLien($l);
                $entity->setRaisonSocial($rS);
                $entity->setCodeFirm($cF);
                $entity->setPublished($published);
                $entity->setDateDebut(new \DateTime($da));
                $entity->setDateFin(new \DateTime($fa));

            }


            $em->persist($entity);
            $em->flush();

//            die(' stop');
            return $this->redirect($this->generateUrl('habillage_list'));

        }
        return $this->render('MagBundle:Default:HabillageEdit.html.twig',array('id'=>$id,'entity'=>$entity,'themes'=>$themes, 'user' => $user));
    }





    public function deleteAction(Habillage $habillage){

        $em = $this->getDoctrine()->getManager();
        $em->remove($habillage);
        $em->flush();


        return $this->redirect($this->generateUrl('habillage_list'));

    }

}