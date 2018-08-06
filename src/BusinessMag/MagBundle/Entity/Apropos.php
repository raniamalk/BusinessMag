<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apropos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\AproposRepository")
 */
class Apropos
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
     * @ORM\Column(name="quiSommesNous", type="text")
     */
    private $quiSommesNous;

    /**
     * @var string
     *
     * @ORM\Column(name="mentionsLegales", type="text")
     */
    private $mentionsLegales;

    /**
     * @var string
     *
     * @ORM\Column(name="champsCGV", type="text")
     */
    private $champsCGV;

    /**
     * @var string
     *
     * @ORM\Column(name="champsCGU", type="text")
     */
    private $champsCGU;


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
     * Set quiSommesNous
     *
     * @param string $quiSommesNous
     * @return Apropos
     */
    public function setQuiSommesNous($quiSommesNous)
    {
        $this->quiSommesNous = $quiSommesNous;

        return $this;
    }

    /**
     * Get quiSommesNous
     *
     * @return string 
     */
    public function getQuiSommesNous()
    {
        return $this->quiSommesNous;
    }

    /**
     * Set mentionsLegales
     *
     * @param string $mentionsLegales
     * @return Apropos
     */
    public function setMentionsLegales($mentionsLegales)
    {
        $this->mentionsLegales = $mentionsLegales;

        return $this;
    }

    /**
     * Get mentionsLegales
     *
     * @return string 
     */
    public function getMentionsLegales()
    {
        return $this->mentionsLegales;
    }

    /**
     * Set champsCGV
     *
     * @param string $champsCGV
     * @return Apropos
     */
    public function setChampsCGV($champsCGV)
    {
        $this->champsCGV = $champsCGV;

        return $this;
    }

    /**
     * Get champsCGV
     *
     * @return string 
     */
    public function getChampsCGV()
    {
        return $this->champsCGV;
    }

    /**
     * Set champsCGU
     *
     * @param string $champsCGU
     * @return Apropos
     */
    public function setChampsCGU($champsCGU)
    {
        $this->champsCGU = $champsCGU;

        return $this;
    }

    /**
     * Get champsCGU
     *
     * @return string 
     */
    public function getChampsCGU()
    {
        return $this->champsCGU;
    }
}
