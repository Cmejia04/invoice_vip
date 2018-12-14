<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 7/12/2018
 * Time: 11:33 AM
 */

namespace App\Form;


use App\Entity\BusinessUnit;
use App\Entity\DealCompany;
use App\Entity\DealCompanyType;
use App\Entity\DealInvoice;
use App\Entity\DealStatus;
use App\EventSubscriber\AddFileInvoinceSubscriber;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DealInvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("dealCompany", EntityType::class, [
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
            ])
            ->add("invoiceNumber", TextType::class)
            ->add("businessUnit", EntityType::class, [
                'class' => BusinessUnit::class,
                'placeholder' => 'Selecciona una unidad de negocio',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository
                        ->createQueryBuilder('bu')
                        ->where('bu.active = 1')
                        ->orderBy('bu.name')
                    ;
                },
            ])
            ->add("purchaseInvoiceDate", DateType::class)
            ->add("totalUnits", NumberType::class, [
                'scale' => 2,
            ])
            ->add("totalQuantity", NumberType::class, [
                'scale' => 2,
            ])
            ->add("fileInvoice", VichFileType::class, [
                'required' => true,
                'allow_delete' => false,
            ])
        ;

//        $builder->addEventSubscriber(AddFileInvoinceSubscriber::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => DealInvoice::class
        ]);
    }
}