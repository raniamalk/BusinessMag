<?php

namespace BusinessMag\MagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hab
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BusinessMag\MagBundle\Entity\HabRepository")
 */
class Hab
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
     * @ORM\Column(name="hab", type="string", length=30)
     */
    private $hab;


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
     * Set hab
     *
     * @param string $hab
     * @return Hab
     */
    public function setHab($hab)
    {
        $this->hab = $hab;

        return $this;
    }

    /**
     * Get hab
     *
     * @return string 
     */
    public function getHab()
    {
        return $this->hab;
    }
}
