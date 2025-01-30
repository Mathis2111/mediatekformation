<?php


namespace App\Form;

use App\Entity\Formation;
use App\Entity\Categorie;
use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Description of AddFormation
 *
 * @author Mathis
 */
class FormationType extends AbstractType{
    
    // Configure les champs du formulaire pour l'entité Formation
     public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => ' Titre'])
            ->add('description', TextType::class, ['required' => false, 'label' => ' Description'])
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text',
                'label' => ' Date de publication',
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\LessThanOrEqual('today'),
                ],
            ])
            ->add('playlist', EntityType::class, [
                'class' => Playlist::class,
                'choice_label' => ' name',
                'label' => ' Playlist',
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => ' Catégories',
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
    }

    // Configure les options par défaut du formulaire
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
