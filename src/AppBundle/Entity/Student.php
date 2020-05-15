<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 * @ORM\HasLifecycleCallbacks()
 */
class Student {
    const SERVER_PATH_TO_IMAGE_FOLDER = '/web/uploads/images';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $first_name;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $last_name;
    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $date_of_birth;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $image_file_name;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_date;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_date;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SchoolClass", inversedBy="students")
     * @ORM\JoinColumn(name="school_class_id", referencedColumnName="id")
     */
    private $schoolClass;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    /**
     * @return UploadedFile
     */
    public function getFile(){
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null){
        $this->file = $file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->filename = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server.
     */
    public function lifecycleFileUpload() {
        $this->upload();
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire.
     */
//    public function refreshUpdated() {
//        $this->setUpdated(new DateTime());
//    }

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
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth() {
        return $this->date_of_birth;
    }

    /**
     * @param mixed $date_of_birth
     */
    public function setDateOfBirth($date_of_birth) {
        $this->date_of_birth = $date_of_birth;
    }

    /**
     * @return mixed
     */
    public function getImageFilename() {
        return $this->image_file_name;
    }

    /**
     * @param mixed $image_file_name
     */
    public function setImageFilename($image_file_name) {
        $this->image_file_name = $image_file_name;
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