<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 09:07 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_ingreso', BirthdayType::class, array(
                'label' => 'Fecha de Ingreso UBV',
            ))
            ->add('trabajo', FileType::class, array('label' => 'Digital Constancia Trabajo'))
            ->add('oposicion', CheckboxType::class, array(
                'label'         => '¿Tiene Concurso de Oposición?',
                'required' => false,
            ))
            ->add('escalafones', EntityType::class, array(
                'label'         => false,
                'placeholder' => 'Seleccione escala a la que concurso',
                'attr' => array(
                    'class' =>  'esc_oposicion'
                ),
                'class' => 'AppBundle:Escalafones',
                'choice_label' => 'getNombre',
            ))
            ->add('fecha_oposicion', BirthdayType::class, array(
                'label' => 'fecha Concurso',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'attr' => array(
                    'class' =>  'esc_oposicion'
                )
            ))
            ->add('documento_oposicion', FileType::class, array(
                'label' => 'Digital Documento Oposición',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'attr' => array(
                    'style' => 'display:none;',
                    'class' =>  'esc_oposicion'
                )
            ))
            ->add('area_investigacion', EntityType::class, array(
                'label'         => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                ),
                'placeholder' => 'Seleccione Area de Investigacion',
                'class' => 'AppBundle:AreasInvestigacion',
                'choice_label' => 'getNombre',
            ))
            ->add('ascenso', CheckboxType::class, array(
                'label'    => '¿Ha tenido Ascenso luego del Concurso?',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                )
            ))



        ;


    }


}