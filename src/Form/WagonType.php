<?php

namespace App\Form;

use App\Entity\Wagon;
use \App\Enum\WagonType as WagonEnumType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WagonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EnumType::class, [
                'class' => WagonEnumType::class,
            ])
            ->add('weight')
            ->add('length')
            ->add('maxPassenger')
            ->add('maxPayload')
            ->add('manufacturer')
            ->add('yearOfManufacture', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy',
            ])
            ->add('serialNo')
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wagon::class,
        ]);
    }
}
