<?php

namespace AppBundle\Admin;

use AppBundle\Entity\SchoolClass;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SchoolClassAdmin extends AbstractAdmin {
    // Fields to be shown on filter forms
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('grade');
    }

    // Fields to be shown on lists
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('id')
            ->add('grade')
            ->add('section')
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
            ->add('grade', null, [
                'help' => 'Set the class grade'
            ])
            ->add('section', null, [
                'help' => 'Set the class section'
            ]);
    }

    // Fields to be shown on show action
    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('grade')
            ->add('section')
            ->add('created_date')
            ->add('modified_date');
    }

    // Update creation success message display
    public function toString($object) {
        return $object instanceof SchoolClass
            ? $object->getSection()
            : 'Student';
    }
}
