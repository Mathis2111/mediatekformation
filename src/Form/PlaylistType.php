<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of Add²Playlist
 *
 * @author Mathis
 */
class PlaylistType extends AbstractType{
    
    // Configure les champs du formulaire pour l'entité Playlist
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => ' Nom'])
            ->add('description', TextType::class, ['required' => false, 'label' => ' Description'])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
    }

    // Configure les options par défaut pour ce formulaire
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
