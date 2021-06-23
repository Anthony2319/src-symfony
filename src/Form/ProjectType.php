<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Student;
use App\Entity\Tag;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('deadline')
            ->add('budget')
            ->add('students', EntityType::class, [
                    'class' => Student::class,
                    
                    'choice_label' => function(Student $student) {
                        return "{$student->getFirstname()} {$student->getLastname()}";
                    },
                    'multiple' => true,
                    'expanded' => true,
                 ])
             ->add('clients')
             ->add('tags', EntityType::class, [
                 'class' => Tag::class,

                 'choice_label' => function(Tag $tag) {
                     return "{$tag->getName()} {$tag->getDescription()}";
                 }
                 
             ])
             ->add('teacher', EntityType::class, [
                // looks for choices from this entity
                'class' => Teacher::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => function(Teacher $teacher) {
                    // On renvoit les attributs firstname et lastname.
                    return "{$teacher->getFirstname()} {$teacher->getLastname()}";
                },
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
