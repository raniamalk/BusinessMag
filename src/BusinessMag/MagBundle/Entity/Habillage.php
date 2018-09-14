<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BusinessMag\MagBundle\MagBundle;
use BusinessMag\MagBundle\Entity\Theme;
use BusinessMag\MagBundle\Entity\Hab;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Habillage
 *
 * @ORM\Table("habillage")
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\HabillageRepository")
 */
class Habillage
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=255)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $raisonSocial;


    /**
     * @var string
     *
     * @ORM\Column(name="codeFirm", type="string", length=10)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $codeFirm;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var Theme
     *
     * @Assert\Type(type="MagBundle\Entity\Theme"  )
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     *
     */

    private $theme;

    /**
     * @var \string
     *
     * @ORM\Column(name=" published ", type="string", nullable=true)
     *
     */
    private $published;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     *
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePub", type="datetime", nullable=true)
     *
     */
    private $dateDebut;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     *
     */
    private $dateFin;




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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }





    /**
     * Set lien
     *
     * @param string $lien
     * @return Habillage
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
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

    /**
     * @return string
     */
    public function getRaisonSocial()
    {
        return $this->raisonSocial;
    }

    /**
     * @param string $raisonSocial
     */
    public function setRaisonSocial($raisonSocial)
    {
        $this->raisonSocial = $raisonSocial;
    }

    /**
     * @return string
     */
    public function getCodeFirm()
    {
        return $this->codeFirm;
    }

    /**
     * @param string $codeFirm
     */
    public function setCodeFirm($codeFirm)
    {
        $this->codeFirm = $codeFirm;
    }

    /**
     * @return string
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param string $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
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
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }


    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }







    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $pathc;
    /**
     * @Assert\File(maxSize="2M", mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Merci d'envoyer un fichier au format .jpg ou .gif")
     *
     */
    public $filec;
    public function getUploadRootDirc()
    {
        return __dir__.'/../../../../web/upload3';

    }
    public function getAbsolutePathc()
    {
        return null === $this->pathc ? null : $this->getUploadRootDirc().'/'.$this->pathc;
    }
    public function getAssetPathc()
    {
        return 'upload3/'.$this->pathc;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadc()
    {
        $this->tempFilec = $this->getAbsolutePathc();
        $this->oldFilec = $this->getPathc();
        $this->updateAt = new \DateTime();
        if (null !== $this->filec)
            $this->pathc = sha1(uniqid(mt_rand(),true)).'.'.$this->filec->guessExtension();
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadc()
    {
        if (null !== $this->filec) {
            $this->filec->move($this->getUploadRootDirc(),$this->pathc);
            unset($this->filec);
            if ($this->oldFilec != null) unlink($this->tempFilec);
        }
    }




    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUploadc()
    {
        $this->tempFilec= $this->getAbsolutePathc();
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUploadc()
    {
        if (file_exists($this->tempFilec)) unlink($this->tempFilec);
    }

    /**
     * @return mixed
     */
    public function getPathc()
    {
        return $this->pathc;
    }

    /**
     * @param mixed $pathc
     */
    public function setPathc($pathc)
    {
        $this->pathc = $pathc;
    }









}
