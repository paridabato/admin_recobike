<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Marquages;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\UrlHelper;



class MarquagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('creermarquages', FileType::class, [
                'mapped' => false,
                'constraints' => [
                    new File()
                ],
                'attr' => ['class' => 'custom-file-input']
            ])
        ;
    }
}