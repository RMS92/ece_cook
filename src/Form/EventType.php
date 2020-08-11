<?php

namespace App\Form;

use App\Entity\Event;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('caption', CKEditorType::class)
            ->add('description', CKEditorType::class)
            ->add('city')
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-width',
                    ]
            ])
            ->add('postal_code')
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
            ->add('takesPlace_at')
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true,
                'attr' => [
                    'is' => 'drop-files',
                    'label' => 'Déposer vos fichiers',
                    'help' => 'Seul les fichiers svg sont acceptés'
                ]
            ])
            ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
