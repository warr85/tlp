<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')            
            ->add('imageName')            
            ->add('imageFile', FileType::class, array('label' => 'Brochure (PDF file)'))
            ->add('modulos', EntityType::class, array(
                'class'     => 'AppBundle:CursoModulo',
                'multiple'  => true,
                'expanded'  => true
            ))
            ->add('grupos', EntityType::class, array(
                'class'     => 'AppBundle:CursoGrupo',
                'multiple'  => true,
                'expanded'  => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Curso'
        ));
    }
}
