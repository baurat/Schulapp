<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="meldungen")
 */
class Meldung {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $start_datum;

    /**
     * @ORM\Column(type="date")
     */
    protected $end_datum;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $ist_eilmeldung;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fuer_lehrer;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $ueberschrift;

    /**
     * @ORM\Column(type="text")
     */
    protected $meldung;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $ist_vertretung;


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
     * Set startDatum
     *
     * @param \DateTime $startDatum
     *
     * @return Meldung
     */
    public function setStartDatum($startDatum)
    {
        $this->start_datum = $startDatum;

        return $this;
    }

    /**
     * Get startDatum
     *
     * @return \DateTime
     */
    public function getStartDatum()
    {
        return $this->start_datum;
    }

    /**
     * Set endDatum
     *
     * @param \DateTime $endDatum
     *
     * @return Meldung
     */
    public function setEndDatum($endDatum)
    {
        $this->end_datum = $endDatum;

        return $this;
    }

    /**
     * Get endDatum
     *
     * @return \DateTime
     */
    public function getEndDatum()
    {
        return $this->end_datum;
    }

    /**
     * Set istEilmeldung
     *
     * @param boolean $istEilmeldung
     *
     * @return Meldung
     */
    public function setIstEilmeldung($istEilmeldung)
    {
        $this->ist_eilmeldung = $istEilmeldung;

        return $this;
    }

    /**
     * Get istEilmeldung
     *
     * @return boolean
     */
    public function getIstEilmeldung()
    {
        return $this->ist_eilmeldung;
    }

    /**
     * Set fuerLehrer
     *
     * @param boolean $fuerLehrer
     *
     * @return Meldung
     */
    public function setFuerLehrer($fuerLehrer)
    {
        $this->fuer_lehrer = $fuerLehrer;

        return $this;
    }

    /**
     * Get fuerLehrer
     *
     * @return boolean
     */
    public function getFuerLehrer()
    {
        return $this->fuer_lehrer;
    }

    /**
     * Set ueberschrift
     *
     * @param string $ueberschrift
     *
     * @return Meldung
     */
    public function setUeberschrift($ueberschrift)
    {
        $this->ueberschrift = $ueberschrift;

        return $this;
    }

    /**
     * Get ueberschrift
     *
     * @return string
     */
    public function getUeberschrift()
    {
        return $this->ueberschrift;
    }

    /**
     * Set meldung
     *
     * @param string $meldung
     *
     * @return Meldung
     */
    public function setMeldung($meldung)
    {
        $this->meldung = $meldung;

        return $this;
    }

    /**
     * Get meldung
     *
     * @return string
     */
    public function getMeldung()
    {
        return $this->meldung;
    }

    /**
     * Set istVertretung
     *
     * @param boolean $istVertretung
     *
     * @return Meldung
     */
    public function setIstVertretung($istVertretung)
    {
        $this->ist_vertretung = $istVertretung;

        return $this;
    }

    /**
     * Get istVertretung
     *
     * @return boolean
     */
    public function getIstVertretung()
    {
        return $this->ist_vertretung;
    }
}
