<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Course
 *
 * @ORM\Table(name="cou_course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Column(name="cou_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="float")
     */
    private $distance;

    /**
     * @ORM\ManyToOne(targetEntity="Chauffeur")
     * @ORM\JoinColumn(name="cha_oid", referencedColumnName="cha_oid")
     */
    private $chauffeur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="adr_oid_depart", referencedColumnName="adr_oid")
     */
    private $adresseDepart;

    /**
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="adr_oid_arrivee", referencedColumnName="adr_oid")
     */
    private $adresseArrivee;

    /**
     * One Course has Many Transports.
     * @ORM\OneToMany(targetEntity="Transport", mappedBy="course")
     */
    private $transports;
    

    /**
     * Constructor
     */
    public function __construct() {
        $this->transports = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set distance
     *
     * @param float $distance
     *
     * @return Course
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }
    

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     *
     * @return Course
     */
    public function setAdresse(\AppBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \AppBundle\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set chauffeur
     *
     * @param \AppBundle\Entity\Chauffeur $chauffeur
     *
     * @return Course
     */
    public function setChauffeur(\AppBundle\Entity\Chauffeur $chauffeur = null)
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    /**
     * Get chauffeur
     *
     * @return \AppBundle\Entity\Chauffeur
     */
    public function getChauffeur()
    {
        return $this->chauffeur;
    }

    /**
     * Set adresseDepart
     *
     * @param \AppBundle\Entity\Adresse $adresseDepart
     *
     * @return Course
     */
    public function setAdresseDepart(\AppBundle\Entity\Adresse $adresseDepart = null)
    {
        $this->adresseDepart = $adresseDepart;

        return $this;
    }

    /**
     * Get adresseDepart
     *
     * @return \AppBundle\Entity\Adresse
     */
    public function getAdresseDepart()
    {
        return $this->adresseDepart;
    }

    /**
     * Set adresseArrivee
     *
     * @param \AppBundle\Entity\Adresse $adresseArrivee
     *
     * @return Course
     */
    public function setAdresseArrivee(\AppBundle\Entity\Adresse $adresseArrivee = null)
    {
        $this->adresseArrivee = $adresseArrivee;

        return $this;
    }

    /**
     * Get adresseArrivee
     *
     * @return \AppBundle\Entity\Adresse
     */
    public function getAdresseArrivee()
    {
        return $this->adresseArrivee;
    }

    /**
     * Add transport
     *
     * @param \AppBundle\Entity\Transport $transport
     *
     * @return Course
     */
    public function addTransport(\AppBundle\Entity\Transport $transport)
    {
        $this->transports[] = $transport;

        return $this;
    }

    /**
     * Remove transport
     *
     * @param \AppBundle\Entity\Transport $transport
     */
    public function removeTransport(\AppBundle\Entity\Transport $transport)
    {
        $this->transports->removeElement($transport);
    }

    /**
     * Get transports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * Get the Course name
     * 
     * @return string
     */
    public function __toString()
    {
        return "Course par ".$this->getChauffeur()." départ de ".$this->getAdresseDepart()." arrivée à ".$this->getAdresseArrivee();
    }
}
