<?php
/**
 * Created by PhpStorm.
 * User: ytu-emre-kaplan
 * Date: 11.06.2018
 * Time: 11:03
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name");
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array("data_class" => Department::class)
        );
    }
}