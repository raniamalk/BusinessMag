<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Professionnel
 *
 * @ORM\Table("professionnel")
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\ProfessionnelRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Professionnel
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
     * @ORM\Column(name="telephone", type="string", length=16)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $lien;

    /**
     * @var \boolean
     *
     * @ORM\Column(name=" published ", type="boolean", nullable=true)
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
     * @ORM\Column(name="updateddAt", type="datetime", nullable=true)
     *
     */
    private $updateddAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime", nullable=true)
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
     * Set raisonSocial
     *
     * @param string $raisonSocial
     * @return Professionnel
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
     * Set telephone
     *
     * @param string $telephone
     * @return Professionnel
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Professionnel
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Professionnel
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
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
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
    public function getUpdateddAt()
    {
        return $this->updateddAt;
    }

    /**
     * @param \DateTime $updateddAt
     */
    public function setUpdateddAt($updateddAt)
    {
        $this->updateddAt = $updateddAt;
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



}
