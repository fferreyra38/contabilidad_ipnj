<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pastor
 *
 * @ORM\Table(name="pastor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PastorRepository")
 */
class Pastor extends Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="es_tesorero_nacional", type="boolean")
     */
    private $es_tesorero_nacional;


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
     * Set es_tesorero_nacional
     *
     * @param boolean $esTesoreroNacional
     * @return Pastor
     */
    public function setEsTesoreroNacional($esTesoreroNacional)
    {
        $this->es_tesorero_nacional = $esTesoreroNacional;

        return $this;
    }

    /**
     * Get es_tesorero_nacional
     *
     * @return boolean 
     */
    public function getEsTesoreroNacional()
    {
        return $this->es_tesorero_nacional;
    }
}
