<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;


class GrossistesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raison_sociale', TextType::class, [
                'label' => 'Raison sociale : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'Code postal : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('contact', TextType::class, [
                'label' => 'Contact : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Mobile : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => ['class' => 'btn btn-info mg-r-5'],
                'row_attr' => ['class' => 'form-layout-footer mg-t-30 float-left'],
            ])
            ->add('reset', ResetType::class, [
                'label' => 'Annuler',
                'attr' => ['class' => 'btn btn-secondary', 'onclick' => 'this.form.reset()'],
                'row_attr' => ['class' => 'form-layout-footer mg-t-30'],
            ])
        ;
    }
}