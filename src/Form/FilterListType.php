<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 13/12/2018
 * Time: 4:01 PM
 */

namespace App\Form;


use App\Entity\DealCompany;
use App\Entity\DealCompanyType;
use App\Entity\DealStatus;
use Doctrine\ORM\EntityRepository;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("keyword", TextType::class, [
                'label' => "Palabra Clave",
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add("distributor", EntityType::class, [
                'class' => DealCompany::class,
                'placeholder' => "Selecciona una compañia",
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository
                        ->createQueryBuilder('c')
                        ->where('c.dealCompanyType IN (:companyTypes)')
                        ->andWhere('c.dealStatus = :status')
                        ->setParameters([
                            'companyTypes' => [ DealCompanyType::DISTRIBUTOR, DealCompanyType::MANUFACTURER ],
                            'status' => DealStatus::ACTIVE
                        ])
                        ;
                },
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add('search', SubmitType::class, [
                'label' => "Buscar",
                'attr' => [
                    'class' => 'btn btn-primary my-2'
                ]
            ])
            ->add('clear', ButtonType::class, [
                'label' => "Limpiar",
                'attr' => [
                    'class' => 'btn btn-secundary my-2'
                ]
            ])
            ->add('back', ButtonType::class, [
                'label' => "Volver",
                'attr' => [
                    'class' => 'btn btn-default my-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}