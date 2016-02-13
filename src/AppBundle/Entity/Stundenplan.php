<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="stunden")
 */
class Stundenplan {
    /**
     * @ORM\Column(type="float")
     * @ORM\Id
     */
    protected $stunde;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $start;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $ende;

    /**
     * Set stunde
     *
     * @param float $stunde
     *
     * @return Stundenplan
     */
    public function setStunde($stunde)
    {
        $this->stunde = $stunde;

        return $this;
    }

    /**
     * Get stunde
     *
     * @return float
     */
    public function getStunde()
    {
        return $this->stunde;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Stundenplan
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set ende
     *
     * @param \DateTime $ende
     *
     * @return Stundenplan
     */
    public function setEnde($ende)
    {
        $this->ende = $ende;

        return $this;
    }

    /**
     * Get ende
     *
     * @return \DateTime
     */
    public function getEnde()
    {
        return $this->ende;
    }
}
