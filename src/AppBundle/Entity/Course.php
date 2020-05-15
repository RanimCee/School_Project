<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="course")
 * @ORM\HasLifecycleCallbacks()
 */
class Course {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $description;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_date;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SchoolClass", inversedBy="courses")
     * @ORM\JoinColumn(name="school_class_id", referencedColumnName="id")
     */
    private $schoolClass;

    /**
     * @return mixed
     */
    public function getSchoolClass() {
        return $this->schoolClass;
    }

    /**
     * @param mixed $schoolClass
     */
    public function setSchoolClass(SchoolClass $schoolClass) {
        $this->schoolClass = $schoolClass;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate() {
        return $this->created_date;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedDate() {
        $this->created_date = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getModifiedDate() {
        return $this->modified_date;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModifiedDate() {
        $this->modified_date = new DateTime();
    }

}