<?php

namespace BusinessMag\MagBundle\Entity;


use BusinessMag\MagBundle\MagBundle;
use BusinessMag\MagBundle\Entity\Theme;
use BusinessMag\MagBundle\Entity\Rubrique;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texteIntro", type="text")
     */
    private $texteIntro;


    /**
     * @var string
     *
     * @ORM\Column(name="texteArticle", type="text")
     *
     */
    private $texteArticle;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     *
     */
    private $createdAt;


    /**
     * @var Theme
     *
     * @Assert\valid()
     * @Assert\Type(type="MagBundle\Entity\Theme"  )
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * 
     */

    private $theme;

    /**
     * @var ArrayCollection Article $article
     * Owning Side
     * @ORM\ManyToMany(targetEntity="Rubrique", inversedBy="articles", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="ArtRub", joinColumns={@ORM\JoinColumn(name="id_article", referencedColumnName="id")}, inverseJoinColumns={@ORM\JoinColumn(name="id_rubrique", referencedColumnName="id")})
     */

    private $rubrique;





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
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texteIntro
     *
     * @param string $texteIntro
     * @return Article
     */
    public function setTexteIntro($texteIntro)
    {
        $this->texteIntro = $texteIntro;

        return $this;
    }

    /**
     * Get texteIntro
     *
     * @return string
     */
    public function getTexteIntro()
    {
        return $this->texteIntro;
    }


    /**
     * Set texteArticle
     *
     * @param string $texteArticle
     * @return Article
     */
    public function setTexteArticle($texteArticle)
    {
        $this->texteArticle = $texteArticle;

        return $this;
    }

    /**
     * Get texteArticle
     *
     * @return string
     */
    public function getTexteArticle()
    {
        return $this->texteArticle;
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

























    /**
     * Set theme
     *
     * @param \BusinessMag\MagBundle\Entity\Theme $theme
     * @return Article
     */
    public function setTheme(\BusinessMag\MagBundle\Entity\Theme $theme)
    {
        $this->theme = $theme;

        return $this;
    }


    /**
     * Get theme
     *
     * @return \BusinessMag\MagBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }


    /**
     * @return ArrayCollection
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * @param ArrayCollection $rubrique
     */
    public function setRubrique($rubrique)
    {
        $this->rubrique = $rubrique;
    }










    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $path;
    /**
     * @Assert\File(maxSize="2M", mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Merci d'envoyer un fichier au format .jpg ou .gif")
     *
     */
    public $file;
    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/uploads';

    }
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }
    public function getAssetPath()
    {
        return 'uploads/'.$this->path;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();
        if (null !== $this->file)
            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
            if ($this->oldFile != null) unlink($this->tempFile);
        }
    }




    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }









    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $patha;
    /**
     * @Assert\File(maxSize="2M", mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Merci d'envoyer un fichier au format .jpg ou .gif")
     *
     */
    public $filea;
    public function getUploadRootDira()
    {
        return __dir__.'/../../../../web/upload';

    }
    public function getAbsolutePatha()
    {
        return null === $this->patha ? null : $this->getUploadRootDira().'/'.$this->patha;
    }
    public function getAssetPatha()
    {
        return 'uploads/'.$this->patha;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploada()
    {
        $this->tempFilea = $this->getAbsolutePatha();
        $this->oldFilea = $this->getPatha();
        $this->updateAt = new \DateTime();
        if (null !== $this->filea)
            $this->patha = sha1(uniqid(mt_rand(),true)).'.'.$this->filea->guessExtension();
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploada()
    {
        if (null !== $this->filea) {
            $this->filea->move($this->getUploadRootDira(),$this->patha);
            unset($this->filea);
            if ($this->oldFilea != null) unlink($this->tempFilea);
        }
    }




    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUploadaa()
    {
        $this->tempFilea= $this->getAbsolutePatha();
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUploada()
    {
        if (file_exists($this->tempFilea)) unlink($this->tempFilea);
    }

    /**
     * @return mixed
     */
    public function getPatha()
    {
        return $this->patha;
    }

    /**
     * @param mixed $patha
     */
    public function setPatha($patha)
    {
        $this->patha = $patha;
    }








    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $pathb;
    /**
     * @Assert\File(maxSize="2M", mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Merci d'envoyer un fichier au format .jpg ou .gif")
     *
     */
    public $fileb;
    public function getUploadRootDirb()
    {
        return __dir__.'/../../../../web/upload2';

    }
    public function getAbsolutePathb()
    {
        return null === $this->pathb ? null : $this->getUploadRootDirb().'/'.$this->pathb;
    }
    public function getAssetPathb()
    {
        return 'uploads/'.$this->pathb;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadb()
    {
        $this->tempFileb = $this->getAbsolutePathb();
        $this->oldFileb = $this->getPathb();
        $this->updateAt = new \DateTime();
        if (null !== $this->fileb)
            $this->pathb = sha1(uniqid(mt_rand(),true)).'.'.$this->fileb->guessExtension();
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadb()
    {
        if (null !== $this->fileb) {
            $this->fileb->move($this->getUploadRootDirb(),$this->pathb);
            unset($this->fileb);
            if ($this->oldFileb != null) unlink($this->tempFileb);
        }
    }




    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUploadab()
    {
        $this->tempFileb= $this->getAbsolutePathb();
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUploadb()
    {
        if (file_exists($this->tempFileb)) unlink($this->tempFileb);
    }

    /**
     * @return mixed
     */
    public function getPathb()
    {
        return $this->pathb;
    }

    /**
     * @param mixed $pathb
     */
    public function setPathb($pathb)
    {
        $this->pathb = $pathb;
    }










}
