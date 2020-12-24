<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;


class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', TextType::class, [
                'label' => 'Image : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => true
            ])
            ->add('reference', TextType::class, [
                'label' => 'Reference : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => true
            ])
            ->add('libelle', TextType::class, [
                'label' => 'Libelle : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => true
            ])
            ->add('tarif_public', TextType::class, [
                'label' => 'Tarif public : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => true
            ])

//            ->add('submit', SubmitType::class, [
//                'label' => 'Mettre à jour',
//                'attr' => ['class' => 'btn btn-info mg-r-5'],
//                'row_attr' => ['class' => 'form-layout-footer mg-t-30 float-left'],
//            ])
//            ->add('reset', ResetType::class, [
//                'label' => 'Annuler',
//                'attr' => ['class' => 'btn btn-secondary', 'onclick' => 'this.form.reset()'],
//                'row_attr' => ['class' => 'form-layout-footer mg-t-30'],
//            ])
        ;
    }
}