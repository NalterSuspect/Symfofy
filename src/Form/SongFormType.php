<?php

namespace App\Form;

use App\Entity\Song;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('discNumber')
            ->add('durationMs')
            ->add('explicit')
            ->add('isrc')
            ->add('spotifyUrl')
            ->add('href')
            ->add('isLocal')
            ->add('name')
            ->add('popularity')
            ->add('previewUrl')
            ->add('trackNumber')
            ->add('type')
            ->add('uri')
            ->add('pictureLink')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
