<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\TypeUtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypeUtilisateur;

class Utilisateur1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('email')
            ->add('adresse')
            ->add('compte')
            ->add('typeutilisateur', EntityType::class, [
                'class' => TypeUtilisateur::class,
                'choice_label' => 'role',
                'choice_value' => 'id',
                'query_builder' => function (TypeUtilisateurRepository $typeUtilisateurRepository) {
                    return $typeUtilisateurRepository->getAdministrateur();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
