<?php

namespace AppBundle\Admin;

use AppBundle\Entity\SchoolClass;
use AppBundle\Entity\Student;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class StudentAdmin extends AbstractAdmin {
    // Fields to be shown on filter forms
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('first_name')
            ->add('last_name')
            ->add('schoolClass', null, [], EntityType::class, [
                'class' => SchoolClass::class,
                'choice_label' => 'section',
            ]);
    }

    // Fields to be shown on lists
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('id')
            ->add('first_name')
            ->add('last_name')
            ->add('date_of_birth')
            ->add('image_file_name')
            ->add('schoolClass.section')
            ->add('schoolClass.grade')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
            ->add('created_date')
            ->add('modified_date');
    }

    // Fields to be shown on create/edit forms
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('Student', ['class' => 'col-md-9'])
                ->add('first_name', null, [
                    'help' => 'Set the student first name'
                ])
                ->add('last_name', null, [
                    'help' => 'Set the student last name'
                ])
                ->add('date_of_birth', null, [
                    'help' => 'Set the date of birth of the student'
                ])
                ->add('image_file_name', null, [
                    'help' => 'Set the student image name'
                ])
                ->add('file', FileType::class, [
                    'help' => 'Upload an image of the student',
                    'required' => false,
                    'mapped' => false
                ])
            ->end()
            ->with('School Class', ['class' => 'col-md-3'])
                ->add('schoolClass', EntityType::class, [
                    'class' => SchoolClass::class,
                    'choice_label' => 'grade',
                ])
                ->add('schoolClass', EntityType::class, [
                    'class' => SchoolClass::class,
                    'choice_label' => 'section',
                ])
                ->add('schoolClass', ModelType::class, [
                    'class' => SchoolClass::class,
                    'property' => 'section',
                ])
            ->end()
        ;
    }

    public function prePersist($image){
        $this->manageFileUpload($image);
    }

    public function preUpdate($image){
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image) {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }

    // Fields to be shown on show action
    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('first_name')
            ->add('last_name')
            ->add('date_of_birth')
            ->add('created_date')
            ->add('modified_date');
    }

    // Update creation success message display
    public function toString($object) {
        return $object instanceof Student
            ? $object->getFirstName()
            : 'Student';
    }
}
