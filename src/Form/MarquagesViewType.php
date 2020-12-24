<?php


namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Marquages;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\UrlHelper;



class MarquagesViewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero', TextType::class, [
                'label' => 'Marquage : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('type_engin', ChoiceType::class, [
                'label' => 'Type d\'engin : <span class="tx-danger"></span>',
                'choices' => array(
                    'Vélo' => 'velo',
                    'Trotinette' => 'trotinette',
                    'Overboard' => 'overboard',
                ),
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('marque', TextType::class, [
                'label' => 'Marque du vélo : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('modele', TextType::class, [
                'label' => 'Modèle du vélo : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('couleur', TextType::class, [
                'label' => 'Couleur du vélo : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('id_statut', EntityType::class, [
                'label' => 'Statut : <span class="tx-danger"></span>',
                'class' => 'App:Statuts',
                'choice_label' => 'nom_statut',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('num_serie_velo', TextType::class, [
                'label' => 'Numéro série vélo : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('num_serie_moteur', TextType::class, [
                'label' => 'Numéro série moteur : <span class="tx-danger"></span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'required' => false,
                'disabled' => true
            ])
            ->add('mum_serie_batterie', TextType::class, [
                'label' => 'Numéro série batterie : <span class="tx-danger"></span>',
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
            'data_class' => 'App\Entity\Marquages',
        ]);
    }

}