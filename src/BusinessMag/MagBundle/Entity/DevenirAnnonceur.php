<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BusinessMag\MagBundle\Entity\Theme;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DevenirAnnonceur
 *
 * @ORM\Table("devenirannonceur")
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\DevenirAnnonceurRepository")
 */
class DevenirAnnonceur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=25)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="telPerso", type="string", length=16)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $telPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPerso", type="string", length=40)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $emailPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=40)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=50)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="telPro", type="string", length=16)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $telPro;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPro", type="string", length=40)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $emailPro;

    /**
     * @var string
     *
     * @ORM\Column(name="pageAcc", type="string", length=50, nullable=true)
     *
     */
    private $pageAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="habillageAcc", type="string", length=20, nullable=true)
     */
    private $habillageAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="banniereAcc", type="string", length=20, nullable=true)
     */
    private $banniereAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="pageTheme", type="string", length=50, nullable=true)
     */
    private $pageTheme;

    /**
     * @var string
     *
     * @ORM\Column(name="banniereThe", type="string", length=20, nullable=true)
     */
    private $banniereThe;

    /**
     * @var string
     *
     * @ORM\Column(name="vignetteThe", type="string", length=20, nullable=true)
     */
    private $vignetteThe;





    /**
     * @var array
     *
     * @ORM\Column(name="sponsTheme", type="array", nullable=true)
     */
    private $sponsTheme;

    /**
     * @var string
     *
     * @ORM\Column(name="pageArticle", type="string", length=50, nullable=true)
     */
    private $pageArticle;


    /**
     * @var string
     *
     * @ORM\Column(name="banniereArt", type="string", length=20, nullable=true)
     */
    private $banniereArt;

    /**
     * @var string
     *
     * @ORM\Column(name="vignetteArt", type="string", length=20, nullable=true)
     */
    private $vignetteArt;

    /**
     * @var array
     *
     * @ORM\Column(name="artTheme", type="array", nullable=true)
     */
    private $artTheme;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     *
     */
    private $createdAt;



    public function __construct()
    {
       $this->createdAt=new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return DevenirAnnonceur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return DevenirAnnonceur
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set telPerso
     *
     * @param string $telPerso
     * @return DevenirAnnonceur
     */
    public function setTelPerso($telPerso)
    {
        $this->telPerso = $telPerso;

        return $this;
    }

    /**
     * Get telPerso
     *
     * @return string 
     */
    public function getTelPerso()
    {
        return $this->telPerso;
    }

    /**
     * Set emailPerso
     *
     * @param string $emailPerso
     * @return DevenirAnnonceur
     */
    public function setEmailPerso($emailPerso)
    {
        $this->emailPerso = $emailPerso;

        return $this;
    }

    /**
     * Get emailPerso
     *
     * @return string 
     */
    public function getEmailPerso()
    {
        return $this->emailPerso;
    }

    /**
     * Set raisonSocial
     *
     * @param string $raisonSocial
     * @return DevenirAnnonceur
     */
    public function setRaisonSocial($raisonSocial)
    {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    /**
     * Get raisonSocial
     *
     * @return string 
     */
    public function getRaisonSocial()
    {
        return $this->raisonSocial;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return DevenirAnnonceur
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set telPro
     *
     * @param string $telPro
     * @return DevenirAnnonceur
     */
    public function setTelPro($telPro)
    {
        $this->telPro = $telPro;

        return $this;
    }

    /**
     * Get telPro
     *
     * @return string 
     */
    public function getTelPro()
    {
        return $this->telPro;
    }

    /**
     * Set emailPro
     *
     * @param string $emailPro
     * @return DevenirAnnonceur
     */
    public function setEmailPro($emailPro)
    {
        $this->emailPro = $emailPro;

        return $this;
    }

    /**
     * Get emailPro
     *
     * @return string 
     */
    public function getEmailPro()
    {
        return $this->emailPro;
    }

    /**
     * Set pageAcc
     *
     * @param string $pageAcc
     * @return DevenirAnnonceur
     */
    public function setPageAcc($pageAcc)
    {
        $this->pageAcc = $pageAcc;

        return $this;
    }

    /**
     * Get pageAcc
     *
     * @return string 
     */
    public function getPageAcc()
    {
        return $this->pageAcc;
    }



    /**
     * @return string
     */
    public function getHabillageAcc()
    {
        return $this->habillageAcc;
    }

    /**
     * @param string $habillageAcc
     */
    public function setHabillageAcc($habillageAcc)
    {
        $this->habillageAcc = $habillageAcc;
    }

    /**
     * @return string
     */
    public function getBanniereAcc()
    {
        return $this->banniereAcc;
    }

    /**
     * @param string $banniereAcc
     */
    public function setBanniereAcc($banniereAcc)
    {
        $this->banniereAcc = $banniereAcc;
    }



    /**
     * Set pageTheme
     *
     * @param string $pageTheme
     * @return DevenirAnnonceur
     */
    public function setPageTheme($pageTheme)
    {
        $this->pageTheme = $pageTheme;

        return $this;
    }

    /**
     * Get pageTheme
     *
     * @return string 
     */
    public function getPageTheme()
    {
        return $this->pageTheme;
    }

    /**
     * @return string
     */
    public function getBanniereThe()
    {
        return $this->banniereThe;
    }

    /**
     * @param string $banniereThe
     */
    public function setBanniereThe($banniereThe)
    {
        $this->banniereThe = $banniereThe;
    }

    /**
     * @return string
     */
    public function getVignetteThe()
    {
        return $this->vignetteThe;
    }

    /**
     * @param string $vignetteThe
     */
    public function setVignetteThe($vignetteThe)
    {
        $this->vignetteThe = $vignetteThe;
    }

    /**
     * @return array
     */
    public function getSponsTheme()
    {
        return $this->sponsTheme;
    }

    /**
     * @param array $sponsTheme
     */
    public function setSponsTheme($sponsTheme)
    {
        $this->sponsTheme = $sponsTheme;
    }



    /**
     * Set pageArticle
     *
     * @param string $pageArticle
     * @return DevenirAnnonceur
     */
    public function setPageArticle($pageArticle)
    {
        $this->pageArticle = $pageArticle;

        return $this;
    }

    /**
     * Get pageArticle
     *
     * @return string 
     */
    public function getPageArticle()
    {
        return $this->pageArticle;
    }

    /**
     * @return string
     */
    public function getBanniereArt()
    {
        return $this->banniereArt;
    }

    /**
     * @param string $banniereArt
     */
    public function setBanniereArt($banniereArt)
    {
        $this->banniereArt = $banniereArt;
    }

    /**
     * @return string
     */
    public function getVignetteArt()
    {
        return $this->vignetteArt;
    }

    /**
     * @param string $vignetteArt
     */
    public function setVignetteArt($vignetteArt)
    {
        $this->vignetteArt = $vignetteArt;
    }

    /**
     * @return array
     */
    public function getArtTheme()
    {
        return $this->artTheme;
    }

    /**
     * @param array $artTheme
     */
    public function setArtTheme($artTheme)
    {
        $this->artTheme = $artTheme;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }




}
