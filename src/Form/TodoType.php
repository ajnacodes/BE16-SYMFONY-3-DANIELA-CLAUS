<?php

namespace App\Form;

use App\Entity\Todo;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;


class TodoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
      $builder
          ->add('name', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('category', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('description', TextAreaType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('priority', ChoiceType::class, [
              'choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'],
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('dueDate', DateTimeType::class, [
              'attr' => ['style' => 'margin-bottom:15px']
          ])
          ->add('save', SubmitType::class, [
              'label' => 'Submit',
              'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']
          ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
      $resolver->setDefaults([
          'data_class' => Todo::class,
      ]);
  }
}