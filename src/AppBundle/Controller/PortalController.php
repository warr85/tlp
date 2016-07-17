<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Usuarios;

class PortalController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
         $login = new Usuarios();
        $form = $this->createForm('AppBundle\Form\RegisterType', $login);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
               
                $login->setPlainPassword($login->getPassword());
                $password = $this->get('security.password_encoder')
                    ->encodePassword($login, $login->getPlainPassword()); //encripta la contraseña
                $login->setPassword($password);                
                $permiso = $this->getDoctrine()->getRepository('AppBundle:Role')->findOneByName("ROLE_CLIENTE");
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
        return $this->render('portal/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(),
        ));
    }
    
    /**
     * 
     * @param Request $request
     * @Route("/cursos/{curso}", name="homepage") 
     */
    
    public function cursosAction(Cursos $curso){
        
        
        
    }
}
