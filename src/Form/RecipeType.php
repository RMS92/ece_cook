<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('caption', CKEditorType::class)
            ->add('description', CKEditorType::class)
            ->add('difficulty', ChoiceType::class, [
                'choices' => $this->getDifficultyChoices()
            ])
            ->add('duration')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'required' => true,
                'choice_label' => 'title',
                'multiple' => false
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'required' => true,
                'choice_label' => 'lastname',
                'multiple' => false
            ])
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
            'data_class' => Recipe::class,
        ]);
    }

    public function getDifficultyChoices()
    {
        $choices = Recipe::DIFFICULTY;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
