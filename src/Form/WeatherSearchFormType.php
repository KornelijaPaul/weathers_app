<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class WeatherSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('token', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => ['maxlength' => 50],
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => ['maxlength' => 85],
            ]);
    }
}