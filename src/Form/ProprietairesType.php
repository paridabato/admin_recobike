<?php


namespace App\Type;

use App\Entity\Proprietaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ProprietairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse', TextType::class, [
                'label' => 'Adresse : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'Code postal : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('date_naissance', DateType::class, [
                'label' => 'Date de naissance : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('raison_sociale', TextType::class, [
                'label' => 'Raison sociale : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => 'Civilité : <span class="tx-danger"></span>',
                'choices' => array(
                    'Monsieur' => 'monsieur',
                    'Madame' => 'madame',
                    'Société' => 'societe',
                ),
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('email', TextType::class, [
                'label' => 'Email : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $options)
    {
        $options->setDefaults([
            'data_class' => 'App\Entity\Proprietaires',
        ]);
    }

}