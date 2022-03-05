<?php
namespace App\Form\Type;

use app\Entity\Product;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
    ->add('name', TextType::class)
    ->add('quantity', IntegerType::class)
    ->add('net_price', NumberType::class)
    ->add('tax', ChoiceType::class, [
        'choices'  => [
            '0%' => 0,
            '5%' => 5,
            '8%' => 8,
            '23%' => 23,
        ],
    ])
    ->add('with_tax_price', NumberType::class)
    ->add('save', SubmitType::class)
    ;
    }

//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => Product::class,
//        ]);
//    }
}