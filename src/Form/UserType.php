<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('lastname')
            ->add('firstname')
            ->add('description', TextareaType::class,[
                'required' => false
            ])
            ->add('function', TextareaType::class, [
                'required' => false
            ])
            ->add('roles', CollectionType::class)
            ->add('password')
        ->add('imageFile', FileType::class, [
            'required' => false,
            'multiple' => false,
            'attr' => [
                'is' => 'drop-files',
                'label' => 'Déposer vos fichiers',
                'help' => 'Seul les fichiers svg sont acceptés'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getRolesChoices()
    {
        $choices = User::ROLES;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
