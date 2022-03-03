<?php

namespace App\Form;

use App\Repository\UtilisateurRepository;

use App\Entity\ProfClasse;
use App\Entity\TypeUtilisateur;
use App\Repository\ProfClasseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe')
            ->add(
                'utilisateur',
                EntityType::class,
                [
                    'class' => ProfClasse::class,
                    'query_builder' => function (ProfClasseRepository $profClasseRepository) {
                        return $profClasseRepository->show_prof();
                    },
                    'attr' => [
                        'class' => "form-select"
                    ]

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfClasse::class,
        ]);
    }
}
