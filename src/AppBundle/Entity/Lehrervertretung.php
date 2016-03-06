<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="vert_lehrervertretungen")
 */
class Lehrervertretung {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $datum;
    
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $klasse;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $lehrkraft;

    /**
     * @ORM\Column(type="float")
     */
    protected $stunde;
 
    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $raum;
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $zusatz;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $lastUpdate;

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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Lehrervertretung
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set klasse
     *
     * @param string $klasse
     *
     * @return Lehrervertretung
     */
    public function setKlasse($klasse)
    {
        $this->klasse = $klasse;

        return $this;
    }

    /**
     * Get klasse
     *
     * @return string
     */
    public function getKlasse()
    {
        return $this->klasse;
    }

    /**
     * Set lehrkraft
     *
     * @param string $lehrkraft
     *
     * @return Lehrervertretung
     */
    public function setLehrkraft($lehrkraft)
    {
        $this->lehrkraft = $lehrkraft;

        return $this;
    }

    /**
     * Get lehrkraft
     *
     * @return string
     */
    public function getLehrkraft()
    {
        return $this->lehrkraft;
    }

    /**
     * Set stunde
     *
     * @param float $stunde
     *
     * @return Lehrervertretung
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
     * Set raum
     *
     * @param string $raum
     *
     * @return Lehrervertretung
     */
    public function setRaum($raum)
    {
        $this->raum = $raum;

        return $this;
    }

    /**
     * Get raum
     *
     * @return string
     */
    public function getRaum()
    {
        return $this->raum;
    }

    /**
     * Set zusatz
     *
     * @param string $zusatz
     *
     * @return Lehrervertretung
     */
    public function setZusatz($zusatz)
    {
        $this->zusatz = $zusatz;

        return $this;
    }

    /**
     * Get zusatz
     *
     * @return string
     */
    public function getZusatz()
    {
        return $this->zusatz;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Lehrervertretung
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }
}
