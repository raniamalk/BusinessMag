<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use BusinessMag\MagBundle\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Rubrique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\RubriqueRepository")
 */
class Rubrique
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;



    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="rubrique", cascade={"persist", "merge"})
     *
     */
    private $articte;



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
     * @return Rubrique
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
     * @return mixed
     */
    public function getArticte()
    {
        return $this->articte;
    }

    /**
     * @param mixed $articte
     */
    public function setArticte($articte)
    {
        $this->articte = $articte;
    }


}
