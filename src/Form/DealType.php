<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 7/12/2018
 * Time: 10:15 AM
 */

namespace App\Form;


use App\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("dealInvoice", DealInvoiceType::class)
            ->add("totalUsd", NumberType::class, [
                'scale' => 2,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => Deal::class
        ]);
    }
}
