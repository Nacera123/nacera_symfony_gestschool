<?php

namespace App\Form;

use App\Entity\TypeUtilisateur;
use App\Entity\Utilisateur;
use App\Repository\TypeUtilisateurRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
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
            ->add('cp')
            ->add('typeutilisateur', EntityType::class, [
                'class' => TypeUtilisateur::class,
                'choice_label' => 'role',
                'choice_value' => 'id',
                'query_builder' => function (TypeUtilisateurRepository $typeUtilisateurRepository) {
                    return $typeUtilisateurRepository->getGestionnaireType();
                },
                'attr' => [
                    'class' => "form-select"
                ]
            ])
            //SELECT * FROM type_utilisateur WHERE role NOT IN ("Gestionnaire_Ecole", "Administrateur");
            //<option value="1">Famille</option>
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
