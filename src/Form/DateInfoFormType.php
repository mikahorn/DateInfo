<?php

namespace App\Form;


use App\Entity\DateInfoEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class DateInfoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('yourDate', DateTimeType::class, [
            'date_label' => 'Starts On',
            'input' => 'datetime',
            'years' => range(1900,2050),
            'format' => 'yyyy-dd-MM',
            'html5' => false,
            'model_timezone' => date_default_timezone_get(),
        ]);
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults ([
            'data_class' => DateInfoEntity::class,
            'scrf_protection' => true
        ]);
    }
}