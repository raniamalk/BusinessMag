<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BusinessMag\MagBundle\Entity\Theme;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PublierArticle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\PublierArticleRepository")
 */
class PublierArticle
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=25)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="telPerso", type="string", length=16)
     */
    private $telPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPerso", type="string", length=40)
     */
    private $emailPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=40)
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=50)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="telPro", type="string", length=16)
     */
    private $telPro;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPro", type="string", length=40)
     */
    private $emailPro;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="text")
     */
    private $article;

    /**
     * @var Theme
     *
     * @Assert\valid()
     * @Assert\Type(type="MagBundle\Entity\Theme"  )
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *@ORM\JoinColumn(name="id_pa", referencedColumnName="id")
     */

    private $theme;


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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * @return PublierArticle
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
     * Set article
     *
     * @param string $article
     * @return PublierArticle
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }




}
