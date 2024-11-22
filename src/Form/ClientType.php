<?php

namespace App\Form;

use App\Entity\adresse;
use App\Entity\Client;
use App\Entity\commande;
use App\Entity\employe;
use App\Entity\produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('siret')
            ->add('mail')
            ->add('password')
            ->add('telephone')
            ->add('coefficient')
            ->add('role')
            ->add('adresse', EntityType::class, [
                'class' => adresse::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('employe', EntityType::class, [
                'class' => employe::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('commande', EntityType::class, [
                'class' => produits::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('prepare', EntityType::class, [
                'class' => commande::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
