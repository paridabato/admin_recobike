<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Utilisateurs;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\UrlHelper;



class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20']
            ])
            ->add('login', TextType::class, [
                'label' => 'Login : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => array(
                    'Administrateur' => 'ROLE_admin',
                    'Gestion magasins' => 'ROLE_magasins',
                    'Gestion propriétaires' => 'ROLE_proprietaires',
                    'Gestion commandes' => 'ROLE_commandes',
                    'Gestion des produits' => 'ROLE_produits',
                    'Fabriquants' => 'ROLE_fabriquants',
                    'Grossistes' => 'ROLE_grossistes',
                    'Kits de marquages' => 'ROLE_kits',
                    'Marquages' => 'ROLE_marquages'
                ),
                'expanded' => true,
                'multiple'=>true,
                'label' => '<h6 class="card-body-title">Droits utilisateurs</h6>
                    <p class="mg-b-20 mg-sm-b-30">Sélectionnez les accès autorisés pour cet utilisateur</p>',
                'label_attr' => ['class' => 'form-check-label w-100'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'attr' => ['class' => 'w-100 mr-5 ml-5'],
            ])
        ;
    }
}