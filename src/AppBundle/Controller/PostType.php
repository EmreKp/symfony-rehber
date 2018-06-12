<?php
/**
 * Created by PhpStorm.
 * User: ytu-emre-kaplan
 * Date: 8.06.2018
 * Time: 09:11
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Department;
use AppBundle\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name")->add("surname")->add("phone")
            ->add("department", EntityType::class, array(
                "class" => Department::class,
                "choice_label" => "name"
            ))
            ->add("superior", EntityType::class, array(
                "class" => Employee::class,
                "choice_label" => function ($choiceValue, $key, $value) {
                    return $choiceValue->getName() . " " . $choiceValue->getSurname();
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            "data_class" => Employee::class
        ));
    }
}