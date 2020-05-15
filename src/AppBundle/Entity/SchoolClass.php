<?php


namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="school_class")
 * @ORM\HasLifecycleCallbacks()
 */
class SchoolClass {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $grade;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $section;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_date;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Course", mappedBy="schoolClass")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Student", mappedBy="schoolClass")
     */
    private $students;

    public function __construct() {
        $this->courses = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents() {
        return $this->students;
    }

    /**
     * @param ArrayCollection $students
     */
    public function setStudents($students) {
        $this->students = $students;
    }

    /**
     * @return ArrayCollection
     */
    public function getCourses() {
        return $this->courses;
    }

    /**
     * @param ArrayCollection $courses
     */
    public function setCourses($courses) {
        $this->courses = $courses;
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
    public function getGrade() {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade) {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getSection() {
        return $this->section;
    }

    /**
     * @param mixed $section
     */
    public function setSection($section) {
        $this->section = $section;
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