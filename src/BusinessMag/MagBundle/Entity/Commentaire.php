<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table("commentaire")
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="commentaire", type="text")
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     *
     */
    private $createdAt;
    
    /**
     * @var Article
     *
     *
     *
     * @ORM\ManyToOne(targetEntity="BusinessMag\MagBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true , onDelete="SET NULL")
     *
     * 
     */
    private $article;

    public function __construct(){
        $this->createdAt= new\DateTime();
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
     * Set commentaire
     *
     * @param string $commentaire
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Commentaire
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
     * Set email
     *
     * @param string $email
     * @return Commentaire
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set article
     *
     * @param \BusinessMag\MagBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\BusinessMag\MagBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \BusinessMag\MagBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
