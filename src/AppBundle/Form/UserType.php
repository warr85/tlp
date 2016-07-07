<?php
/**
 * Created by Netbeans.
 * User: Wilmer Ramones
 * Date: 29/06/16
 * Time: 09:07 AM
 * Modificado: 07/07/2016
 */

namespace AppBundle\Form;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\FileValidator;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_ingreso', BirthdayType::class, array(
                'label' => 'Fecha de Ingreso UBV',
                'data' => new \DateTime("01/01/2014")
            ))
            ->add('trabajo', FileType::class, array(
                'label' => 'Digital Constancia Trabajo',
               'constraints' => array(
                   new NotBlank(),
                   new File(array('maxSize' => '1024K'))
               )
           ))
            ->add('pregrado', FileType::class, array(
                'label' => 'Digital Título de Pregrado',
                'constraints' => array(
                    new NotBlank(),
                    new File(array('maxSize' => '1024K'))
                )
            ))
            
            ->add('postgrado', FileType::class, array(
                'label' => 'Digital Título de Postgrado',
                'required' => false, 
                'constraints' => array(
                   new File(array('maxSize' => '1024K')) 
                )
              ))
            ->add('oposicion', CheckboxType::class, array(
                'label'         => '¿Tiene Concurso de Oposición?',
                'required' => false,
            ))
            ->add('escala', EntityType::class, array(
                'label'         => false,
                'placeholder' => 'Seleccione escala a la que concurso',
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                ),
                'class' => 'AppBundle:Escalafones',
                'choice_label' => 'getNombre',
            ))
            ->add('fecha_oposicion', BirthdayType::class, array(
                'label' => 'Fecha Concurso de Oposición',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                )
            ))
            ->add('documento_oposicion', FileType::class, array(
                'label' => 'Digital Documento Oposición',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'required' => false,
                'attr' => array(
                    'style' => 'display:none;',
                    'class' =>  'esc_oposicion'
                )
            ))

            ->add('lineas_investigacion', EntityType::class, array(
                'label'         => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                ),
                'placeholder' => 'Seleccione Área y Línea de Investigación',
                'required' => false,
                'class' => 'AppBundle:LineasInvestigacion',

                'choice_label' => 'getNombre',
                'group_by'      => 'getIdAreaInvestigacion'
            ))

            ->add('titulo_trabajo', TextType::class, array(
                'label' => 'Título del Trabajo de Investigación',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                )
            ))

            ->add('ascenso', CheckboxType::class, array(
                'label'    => '¿Ha tenido Ascenso luego del Concurso?',
                'label_attr'    => array( 'class' => 'esc_oposicion'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_oposicion'
                )
            ))
            //Ascensos:
            //Asistente
            ->add('fecha_ascenso_asistente', BirthdayType::class, array(
                'label' => 'fecha ascenso ASISTENTE',
                'required' => false,
                'label_attr'    => array( 'class' => 'esc_asistente'),
                'attr' => array(
                    'class' =>  'esc_asistente'
                )
            ))
            
            ->add('documento_asistente', FileType::class, array(
                'label' => 'Digital Documento Asistente',
                'label_attr'    => array( 'class' => 'esc_asistente'),
                'required' => false,
                'attr' => array(     
                	'style' => 'display:none;',               
                    'class' =>  'esc_asistente'
                )
            ))
            
            ->add('ascenso2', CheckboxType::class, array(
                'label'    => '¿otro Ascenso?',
                'label_attr'    => array( 'class' => 'esc_asistente'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_asistente'
                )
            ))
            


            //Asociado
            ->add('fecha_ascenso_asociado', BirthdayType::class, array(
                'label' => 'fecha ascenso ASOCIADO',
                'label_attr'    => array( 'class' => 'esc_asociado'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_asociado'
                )
            ))

            ->add('documento_asociado', FileType::class, array(
                'label' => 'Digital Documento asociado',
                'label_attr'    => array( 'class' => 'esc_asociado'),
                'required' => false,
                'attr' => array(
                    'style' => 'display:none;',
                    'class' =>  'esc_asociado'
                )
            ))

            ->add('ascenso3', CheckboxType::class, array(
                'label'    => '¿Otro Ascenso?',
                'label_attr'    => array( 'class' => 'esc_asociado'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_asociado'
                )
            ))

            //Agregado
            ->add('fecha_ascenso_agregado', BirthdayType::class, array(
                'label' => 'fecha ascenso AGREGADO',
                'label_attr'    => array( 'class' => 'esc_agregado'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_agregado'
                )
            ))

            ->add('documento_agregado', FileType::class, array(
                'label' => 'Digital Documento agregado',
                'label_attr'    => array( 'class' => 'esc_agregado'),
                'required' => false,
                'attr' => array(
                    'style' => 'display:none;',
                    'class' =>  'esc_agregado'
                )
            ))

            ->add('ascenso4', CheckboxType::class, array(
                'label'    => '¿Otro Ascenso?',
                'label_attr'    => array( 'class' => 'esc_agregado'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_agregado'
                )
            ))


            //Titular
            ->add('fecha_ascenso_titular', BirthdayType::class, array(
                'label' => 'fecha ascenso TITULAR',
                'label_attr'    => array( 'class' => 'esc_titular'),
                'required' => false,
                'attr' => array(
                    'class' =>  'esc_titular'
                )
            ))

            ->add('documento_titular', FileType::class, array(
                'label' => 'Digital Documento titular',
                'label_attr'    => array( 'class' => 'esc_titular'),
                'required' => false,
                'attr' => array(
                    'style' => 'display:none;',
                    'class' =>  'esc_titular'
                )
            ))

            
		  ->add('send', SubmitType::class, array('label' => 'Enviar Solicitud'))


        ;


    }
    
    


}
