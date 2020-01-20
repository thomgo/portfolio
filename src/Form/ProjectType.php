<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label'=>'Titre'])
            ->add('description', null, ['label'=>'Description'])
            ->add('viewLink', null, ['label'=>'Lien vers le site'])
            ->add('codeLink', null, ['label'=>'Lien vers le code'])
            ->add('position', null, ['label'=>'Position'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
