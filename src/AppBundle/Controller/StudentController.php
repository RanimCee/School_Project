<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\SchoolClass;
use AppBundle\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller {

    public function createStudentAction(){
        $entityManager = $this->getDoctrine()->getManager();

        $schoolClass = new SchoolClass();
        $schoolClass->setSection("B");
        $schoolClass->setGrade(3);

        $student = new Student();
        $student->setFirstName("John");
        $student->setLastName("Mars");
        $student->setDateOfBirth("25/03/1990");
        $student->setImageFilename("edf.jpeg");
        $student->setSchoolClass($schoolClass);

        $entityManager->persist($schoolClass);
        $entityManager->persist($student);
        $entityManager->flush();

        return new Response(
            '<html><body>Saved new school class with id: '.$schoolClass->getId()
            .' and new student with id: '.$student->getId()
            .'</body></html>'
        );
    }

    public function listAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $students = $entityManager->getRepository('AppBundle:Student')->findAll();
        dump($students);
        $classes = $entityManager->getRepository('AppBundle:SchoolClass')->findAll();
        dump($classes);
        die;
    }

    public function deleteAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $schoolClass = $entityManager->getRepository(SchoolClass::class)->find(4);

        $entityManager->remove($schoolClass);
        $entityManager->flush();

        return new Response('deleted');
    }

    public function showSpecificStudentAction($studentID) {
       $student = $this->getDoctrine()->getRepository(Student::class)->find($studentID);
       $schoolClass = $student->getSchoolClass();
       dump($student);
       dump($schoolClass);
        return $this->render('menu/menu.html.twig');
//       return new Response($schoolClass->getSection());
    }

    public function addCourseAction(){
        $entityManager = $this->getDoctrine()->getManager();

        $schoolClass = new SchoolClass();
        $schoolClass->setSection("C");
        $schoolClass->setGrade(3);

        $course = new Course();
        $course->setName("Java");
        $course->setDescription("Java is a general-purpose programming language that is class-based, object-oriented, and designed to have as few implementation dependencies as possible");
        $course->setSchoolClass($schoolClass);

        $entityManager->persist($schoolClass);
        $entityManager->persist($course);
        $entityManager->flush();

        return new Response(
            '<html><body>Saved new school class with id: ' . $schoolClass->getId()
            . ' and new course with id: ' . $course->getId()
            . '</body></html>'
        );
    }
 }