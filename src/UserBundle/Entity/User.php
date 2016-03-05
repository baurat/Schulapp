<?php

// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $vorname;
      
    /**
     * @ORM\Column(type="date")
     */
    protected $gebdatum;
    
    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $geschlecht;

    public function __construct() {
        parent::__construct();
        // your own logic
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set vorname
     *
     * @param string $vorname
     *
     * @return User
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set gebdatum
     *
     * @param \DateTime $gebdatum
     *
     * @return User
     */
    public function setGebdatum($gebdatum)
    {
        $this->gebdatum = $gebdatum;

        return $this;
    }

    /**
     * Get gebdatum
     *
     * @return \DateTime
     */
    public function getGebdatum()
    {
        return $this->gebdatum;
    }

    /**
     * Set geschlecht
     *
     * @param string $geschlecht
     *
     * @return User
     */
    public function setGeschlecht($geschlecht)
    {
        $this->geschlecht = $geschlecht;

        return $this;
    }

    /**
     * Get geschlecht
     *
     * @return string
     */
    public function getGeschlecht()
    {
        return $this->geschlecht;
    }
}
