<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vert_mensaplan")
 */
class Speiseplan {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=2)
     */
    protected $kalenderwoche;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $tag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $mittagessen;


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
     * Set kalenderwoche
     *
     * @param integer $kalenderwoche
     *
     * @return Speiseplan
     */
    public function setKalenderwoche($kalenderwoche)
    {
        $this->kalenderwoche = $kalenderwoche;

        return $this;
    }

    /**
     * Get kalenderwoche
     *
     * @return integer
     */
    public function getKalenderwoche()
    {
        return $this->kalenderwoche;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Speiseplan
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set mittagessen
     *
     * @param string $mittagessen
     *
     * @return Speiseplan
     */
    public function setMittagessen($mittagessen)
    {
        $this->mittagessen = $mittagessen;

        return $this;
    }

    /**
     * Get mittagessen
     *
     * @return string
     */
    public function getMittagessen()
    {
        return $this->mittagessen;
    }
}
