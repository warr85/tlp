<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of RegisterFormType
 *
 * @author ricardo
 */
class RegisterType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', TextType::class, array(
                    'attr'  => array('placeholder' => 'Nombre de usuario...'),
                    'label' => FALSE,
                    'constraints'   => array(
                        new NotBlank(),
                        new Length(array('min' => 3)),
                    )
                ))
                
                ->add('email', EmailType::class, array(
                    'attr'  => array('placeholder' => 'Direccion de Correo...'),
                    'label' => FALSE,
                    'constraints'   => array(
                        new NotBlank(),
                        new Email(),
                    )
                ))
                
                ->add('password', PasswordType::class, array(
                    'attr'  => array('placeholder' => 'Contraseña...'),
                    'label' => FALSE,
                    'constraints'   => array(
                        new NotBlank(),
                        new Length(array('min' => 6)),
                    )
                ))
                
               ->add('register', SubmitType::class, array(
                    'label' => '  Registrarse',
                     'attr'  => array(
                         'class'                => 'btn btn-warning btn- btn-lg btn-block',
                         'data-loading-text'    => "<i class='fa fa-spinner fa-spin'></i> &nbsp; Enviando..."
                      ) 
                ))
        ;
    }
}
