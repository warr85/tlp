<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 10:02 AM
 */

// src/AppBundle/Controller/SecurityController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Usuarios;

/**
 * Security controller.
 *
 * @Route("/security")
 */

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    
    /**
     * @Route("/registrar", name="registrarse")
     */
    public function registerAction(Request $request)
    {
       
          $login = new Usuarios();
        $form = $this->createForm('AppBundle\Form\RegisterType', $login);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
               
                $login->setPlainPassword($login->getPassword());
                $password = $this->get('security.password_encoder')
                    ->encodePassword($login, $login->getPlainPassword()); //encripta la contraseña
                $login->setPassword($password);                
                $permiso = $this->getDoctrine()->getRepository('AppBundle:Role')->findOneByName("ROLE_DOCENTE");
                $login->addRol($permiso); //le añade la permisología básica de docente
                
                
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($login);
                
                
                $em->flush(); //guarda en la base de datos
                
                $this->addFlash('notice', 'Datos enviados Satisfactoriamente.  Hemos enviado un correo a la dirección suministrada con los datos para el ingreso');


                /*$message = \Swift_Message::newInstance()
                    ->setSubject('Bienvenido al sistema CEA@UBV')
                    ->setFrom('wilmer.ramones@gmail.com')
                    ->setTo($form->get('correo')->getData())
                    ->setBody(
                        $this->renderView(
                            'correos/solicitud_adscripcion.html.twig',
                            array(
                                'nombres'   => $form->get('nombres')->getData(),
                                'apellidos' => $form->get('apellidos')->getData(),
                                'usuario'   => $login->getUsername(),
                                'contra'    => $login->getPlainPassword(),

                            )
                        ),
                        'text/html'
                    )
                    /*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    
                ;
                $this->get('mailer')->send($message);     */                                       
        }

        // replace this example code with whatever you need
        return $this->render('security/register.html.twig', array(            
            'form' => $form->createView(),
        ));
    }
    

    /**
     * @Route("/verificar", name="verificar")
     */
    public function verificarAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('login'));
        }


        if($this->isGranted('ROLE_DOCENTE')){
            return $this->redirect($this->generateUrl('solicitud_adscripcion'));
        }
    }
}