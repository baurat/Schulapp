<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="vert_schuelervertretungen")
 */
class Vertretung {
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
     * @ORM\Column(type="string", length=10)
     */
    protected $klasse;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $lehrkraft;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $stunde;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $vertretung;
    
    /**
     * @ORM\Column(type="string", length=8)
     */
    protected $raum;
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $zusatz;

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
     * @return Vertretung
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
     * @return Vertretung
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
     * @return Vertretung
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
     * @param string $stunde
     *
     * @return Vertretung
     */
    public function setStunde($stunde)
    {
        $this->stunde = $stunde;

        return $this;
    }

    /**
     * Get stunde
     *
     * @return string
     */
    public function getStunde()
    {
        return $this->stunde;
    }

    /**
     * Set vertretung
     *
     * @param string $vertretung
     *
     * @return Vertretung
     */
    public function setVertretung($vertretung)
    {
        $this->vertretung = $vertretung;

        return $this;
    }

    /**
     * Get vertretung
     *
     * @return string
     */
    public function getVertretung()
    {
        return $this->vertretung;
    }

    /**
     * Set raum
     *
     * @param string $raum
     *
     * @return Vertretung
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
     * @return Vertretung
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
}
