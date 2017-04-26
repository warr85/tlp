<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscripcionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->grupos = $options['grupos'];
        $builder            
            ->add('idCursoGrupo', EntityType::class, array(
                'class' => 'AppBundle\Entity\CursoGrupo',
                'label' => ' Seleccion Grupo ',
                'choices' => $this->grupos,
                'expanded' => false,
                'placeholder' => 'Grupos Disponibles...',
                'constraints'   => array(
                    new NotBlank(),
                )
            ))
            ->add('register', SubmitType::class, array(
                'label' => '  Inscribirse',
                'attr'  => array(
                    'class'                => 'btn btn-warning btn- btn-lg btn-block',
                    'data-loading-text'    => "<i class='fa fa-spinner fa-spin'></i> &nbsp; Enviando..."
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Inscripcion',
            'grupos' => null,
        ));
    }
}
