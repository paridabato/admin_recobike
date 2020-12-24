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


class MagasinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if(is_null($builder->getData()->getId())){
            $builder
                ->add('numero_client', ChoiceType::class, [
                    'choices' => array(
                        'Oui' => true,
                        'Non' => false,
                    ),
                    'expanded' => true,
                    'mapped' => false,
                    'label' => 'Disposez vous d’un numéro de client Recobike ?',
                    'label_attr' => ['class' => 'form-check-label'],
                    'row_attr' => ['class' => 'row mg-t-20'],
                    'disabled' => is_null($options['data']->getId())?false:true
                ])
                ->add('num_client_recobike', TextType::class, [
                    'label' => 'Numéro de client : <span class="tx-danger">*</span>',
                    'attr' => ['class' => 'form-control'],
                    'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                    'label_html' => true,
                    'row_attr' => ['class' => 'row mg-t-20'],
                    'disabled' => is_null($options['data']->getId())?false:true
                ])
            ;
        }

        if(!is_null($builder->getData()->getNumClientRecobike()) || !empty($builder->getData()->getNumClientRecobike())) {
            $builder
                ->add('num_client_recobike', TextType::class, [
                    'label' => 'Numéro de client : <span class="tx-danger">*</span>',
                    'attr' => ['class' => 'form-control'],
                    'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                    'label_html' => true,
                    'row_attr' => ['class' => 'row mg-t-20'],
                    'disabled' => is_null($options['data']->getId())?false:true
                ])
            ;
        }

        $builder
            ->add('raison_sociale', TextType::class, [
                'label' => 'Nom du magasin : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse postale : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'Code postal : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('siret', TextType::class, [
                'label' => 'Numéro SIRET : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('contact', TextType::class, [
                'label' => 'Nom du contact : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($options['data']->getId())?false:true
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Mobile : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('re_mobile', TelType::class, [
                'label' => 'Confirmation mobile : <span class="tx-danger">*</span>',
                'mapped' => false,
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
                'disabled' => is_null($builder->getData()->getId())?false:true
            ]);

            if(is_null($builder->getData()->getId())){
                $builder->add('re_email', EmailType::class, [
                    'label' => 'Confirmation email : <span class="tx-danger">*</span>',
                    'mapped' => false,
                    'attr' => ['class' => 'form-control no_paste'],
                    'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                    'label_html' => true,
                    'row_attr' => ['class' => 'row mg-t-20'],
                ]);
            }

        $builder
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe : <span class="tx-danger">*</span>',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
            ])
            ->add('re_password', PasswordType::class, [
                'label' => 'Confirmation mot de passe : <span class="tx-danger">*</span>',
                'mapped' => false,
                'attr' => ['class' => 'form-control no_paste'],
                'label_attr' => ['class' => 'col-sm-4 form-control-label'],
                'label_html' => true,
                'row_attr' => ['class' => 'row mg-t-20'],
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