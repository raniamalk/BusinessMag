<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table("theme")
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\ThemeRepository")
 */
class Theme
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
     * @ORM\Column(name="nom", type="string", length=50)
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="theme", cascade={"remove"})
     *
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Habillage", mappedBy="theme", cascade={"remove"})
     *
     */
    private $habillage;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="PublierArticle", mappedBy="theme", cascade={"remove"})
     *
     */
    private $publierArticle;

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
     * @return Theme
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
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param string $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getHabillage()
    {
        return $this->habillage;
    }

    /**
     * @param string $habillage
     */
    public function setHabillage($habillage)
    {
        $this->habillage = $habillage;
    }

    /**
     * @return string
     */
    public function getPublierArticle()
    {
        return $this->publierArticle;
    }

    /**
     * @param string $publierArticle
     */
    public function setPublierArticle($publierArticle)
    {
        $this->publierArticle = $publierArticle;
    }



}
