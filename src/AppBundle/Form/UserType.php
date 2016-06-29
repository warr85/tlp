<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 09:07 AM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idRolInstitucion', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:RolInstitucion',

                // use the User.username property as the visible option string
                'choice_label' => 'id',

            ))
            ->add('rol', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:Role',

                // use the User.username property as the visible option string
                'choice_label' => 'id',

            ))
            ->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuarios',
        ));
    }
}