<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null,[
                'label'=>'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description',
                'attr'=> ['rows'=>2]
            ])
            ->add('author',null,[
                'label'=> 'Auteur'
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'label'=> 'Catégorie',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
