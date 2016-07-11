<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Adscripcion;


/**
 * Description of DocenteController
 *
 * @author ubv-cipee
 *
 * @Route("/ceapp")
 * 
 */
 
class AppController extends Controller {

    /**
     * Pagina principal de inicio de la session Docente.
     *
     * @Route("/", name="cea_index")
     * @Method("GET")
     */
    public function indexAction()
    {
       $adscripcion = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->
                findOneByIdRolInstitucion($this->getUser()->getIdRolInstitucion()->getId());
       //si no ha solicitado adscripción regresa a la pagina de adscripcion
        if(!$adscripcion) return $this->redirect($this->generateUrl('solicitud_adscripcion'));
        //solicitud aprobada está en falso
        $adscrito = false;
        if($adscripcion->getIdEstatus()->getId() == 1) $adscrito = true;
        
        return $this->render('cea/index.html.twig', array (
            'adscrito' => $adscrito
        ));
    }
    
    /**
     * Pagina principal de inicio de la session Docente.
     *
     * @Route("/solicitudes/adscripcion/{estatus}", name="cea_adscripciones")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_COORDINADOR_NACIONAL')")
     */
    public function verSolicitudesAction($estatus = 2, Request $request)
    {
        
        if ($request->getMethod() != 'POST') {
            $adscripciones = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findBy(array('idEstatus' => $estatus));
            switch ($estatus){
                case 1: 
                    $mensaje = "activas";
                    break;
                case 2: 
                    $mensaje = "en espera";
                    break;
                case 3:
                    $mensaje = "rechazadas";
                    break;
            }
        }else{
            
            $persona = $this->getDoctrine()->getRepository('AppBundle:Persona')
                              ->findOneByCedulaPasaporte($request->get('docente'));
            
             if (!$persona) {
                $this->addFlash('danger', 'Docente ' . $request->get('docente') . ' no Registrado en la Base de Datos del Centro de Estudios.');
               return $this->render('cea/index.html.twig', array (
                    'adscrito' => true
                ));
            }
            
            //1. obtener el rol-institucion-persona
            $rol = $this->getDoctrine()->getRepository(
                'AppBundle:RolInstitucion')->findOneByIdRol(
                    $this->getDoctrine()->getRepository(
                        'AppBundle:Rol')->findOneByIdPersona($persona));

            //si no existe el rol del docente, enviar correo al encargado de la región para verificar.
            if (!$rol) {
                $this->addFlash('danger', 'Docente no Registrado en la Base de Datos del Centro de Estudios.  Por Favor');
                 return $this->render('cea/index.html.twig');
            }
            
            
            $adscripciones = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findByIdRolInstitucion($rol->getId());
            $mensaje = "Busqueda : " . $request->get('docente');
        }
        return $this->render('cea/solicitudes.html.twig', array(
            'adscripciones' => $adscripciones,
            'estatus_adscripciones' => $mensaje
        ));
    }
    
    /**
     * Encuentra y muestra una entidad de tipo Adscripción.
     *
     * @Route("/solicitudes/{id}", name="cea_solicitudes_show")
     * @Method("GET")
     */
    public function solicitudesShowAction(Adscripcion $adscripcion)
    {
        //$deleteForm = $this->createDeleteForm($usuario);
        $escala = $this->getDoctrine()->getRepository('AppBundle:DocenteEscala')->findBy(array(
            'idRolInstitucion' => $adscripcion->getIdRolInstitucion()->getId()
        ));

        return $this->render('cea/solicitudes_mostar.html.twig', array(
            'adscripcion' => $adscripcion, 
            'escalas' => $escala
        ));
    }
    
    
    /**
     * Encuentra y muestra una entidad de tipo Adscripción.
     *
     * @Route("/solicitudes/actualizar/{id}/{estatus}", name="cea_solicitudes_actualizar")
     * @Method({"GET", "POST"})
     */
    public function solicitudesEditAction(Adscripcion $adscripcion, $estatus)
    {
        
       $adscripciones = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findOneById($adscripcion->getId());
       
       if($estatus == "true") {
           $adscripciones->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(1));
           $user = $this->getDoctrine()->getRepository('AppBundle:Usuarios')->findOneByIdRolInstitucion($adscripcion->getIdRolInstitucion());
           $user->addRol($this->getDoctrine()->getRepository('AppBundle:Role')->findOneByName("ROLE_ADSCRITO"));
                                            
       }else{
           $adscripciones->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(3));
           $user = $this->getDoctrine()->getRepository('AppBundle:Usuarios')->findOneByIdRolInstitucion($adscripcion->getIdRolInstitucion());
           $user->removeRol($this->getDoctrine()->getRepository('AppBundle:Role')->findOneByName("ROLE_ADSCRITO"));
       }
           
       $em = $this->getDoctrine()->getManager();
       $em->persist($adscripciones);
       $em->persist($user);
       $em->flush();
       
       $message = \Swift_Message::newInstance()
                    ->setSubject('Resultado Adscripcion CEA@UBV')
                    ->setFrom('wilmer.ramones@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'correos/actualizar_adscripcion.html.twig',
                            array(
                                'nombres'   => $user->getUsername(),
                                'estatus'   => $adscripciones->getIdEstatus()
                            )
                        ),
                        'text/html'
                    )                    
                ;
                $this->get('mailer')->send($message);
       
       $this->addFlash('notice', 'Solicitud Actualizada Correctamente, hemos enviado un correo al docente notificandole los cambios.');
       
       $escala = $this->getDoctrine()->getRepository('AppBundle:DocenteEscala')->findBy(array(
            'idRolInstitucion' => $adscripciones->getIdRolInstitucion()->getId()
        ));
       
        return $this->render('cea/solicitudes_mostar.html.twig', array(
            'adscripcion' => $adscripciones, 
            'escalas' => $escala
        ));
       
    }
    
}
 