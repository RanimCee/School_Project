<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Course;
use AppBundle\Entity\SchoolClass;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CourseAdmin extends AbstractAdmin {
    // Fields to be shown on filter forms
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('name');
    }

    // Fields to be shown on lists
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('description')
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
            ->with('Course', ['class' => 'col-md-9'])
                ->add('name', null, [
                    'help' => 'Set the course name'
                ])
                ->add('description', null, [
                    'help' => 'Set the course description'
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
            ->end();
    }

    // Fields to be shown on show action
    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('created_date')
            ->add('modified_date');
    }

    // Update creation success message display
    public function toString($object) {
        return $object instanceof Course
            ? $object->getName()
            : 'Course';
    }
}
