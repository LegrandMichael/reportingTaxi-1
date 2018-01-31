<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="ncp_nn_cou_pas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransportRepository")
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="tra_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many Transports have One Course.
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="transports")
     * @ORM\JoinColumn(name="cou_oid", referencedColumnName="cou_oid")
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="Passager")
     * @ORM\JoinColumn(name="pas_oid", referencedColumnName="pas_oid")
     */
    private $passager;


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
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Transport
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set passager
     *
     * @param \AppBundle\Entity\Passager $passager
     *
     * @return Transport
     */
    public function setPassager(\AppBundle\Entity\Passager $passager = null)
    {
        $this->passager = $passager;

        return $this;
    }

    /**
     * Get passager
     *
     * @return \AppBundle\Entity\Passager
     */
    public function getPassager()
    {
        return $this->passager;
    }
}
