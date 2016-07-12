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
use AppBundle\Entity\DocenteServicio;


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
     * Muestra las Solicitudes de Adscripción.  Por defecto las creadas (estatus = 2)
     *
     * @Route("/solicitudes/adscripcion/{estatus}", name="cea_adscripciones")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_COORDINADOR_NACIONAL')")
     */
    public function verSolicitudesAdscripcionAction($estatus = 2, Request $request)
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
    public function solicitudesAdscripcionShowAction(Adscripcion $adscripcion)
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
    public function solicitudesAdscripcionEditAction(Adscripcion $adscripcion, $estatus)
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
    
     
    /**
     * Muestra la página Puede ver los estatus de las solicitudes realizadas
     * y permite realizar la solicitud
     *
     * @Route("/servicios/{tipo}/{estatus}", name="cea_servicios")
     * @Method({"GET", "POST"})
     */
    public function verServiciosAction(Request $request, $tipo="antiguedad", $estatus=2){
        
        if ($tipo == "antiguedad") $tipo_servicio = 1;
         if ($request->getMethod() != 'POST') {
            $servicios = $this->getDoctrine()->getRepository('AppBundle:DocenteServicio')->findBy(array(
                                'idEstatus'     => $estatus,
                                'idServicioCe'  => $tipo_servicio,
                    ));
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
            
            
            $servicios = $this->getDoctrine()->getRepository('AppBundle:DocenteServicio')->findByIdRolInstitucion($rol->getId());
            $mensaje = "Busqueda : " . $request->get('docente');
        }
        return $this->render('cea/servicios.html.twig', array(
            'servicios'          => $servicios,
            'estatus_servicio'   => $mensaje,
            'tipo'               => $tipo
        ));
                                
        
    }
    
    
    /**
     * Encuentra y muestra una entidad de tipo Servicios Docente.
     *
     * @Route("/ver_servicio/{id}", name="cea_servicio_show")
     * @Method("GET")
     */
    public function serviciosShowAction(DocenteServicio $servicio)
    {        
        $adscripcion = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findOneByIdRolInstitucion($servicio->getIdRolInstitucion());
        $escala = $this->getDoctrine()->getRepository('AppBundle:DocenteEscala')->findOneBy(array(
                'idRolInstitucion' => $servicio->getIdRolInstitucion(),
                 'idTipoEscala'   => 1
        ));        
        return $this->render('cea/servicios_mostar.html.twig', array(
            'servicio' => $servicio,
            'oposicion' => $escala,
            'adscripcion' => $adscripcion
        ));
    }
    
    
    /**
     * Muestra la página donde explica brevemente el reconocimiento de Antiguedad
     * y permite realizar la solicitud
     *
     * @Route("/mis_servicios/", name="servicios_index")
     * @Method({"GET", "POST"})
     */
    public function serviciosIndexAction(){
        
        $servicios = $this->getDoctrine()->getRepository('AppBundle:DocenteServicio')->findByIdRolInstitucion($this->getUser()->getIdRolInstitucion());
        $adscripcion = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findByIdRolInstitucion($this->getUser()->getIdRolInstitucion());
        
        
        return $this->render('solicitudes/index.html.twig', array(
            'servicios' => $servicios,
            'adscripcion' => $adscripcion
        ));
    }
    
    
    /**
     * Encuentra y muestra una entidad de tipo Adscripción.
     *
     * @Route("/servicios/actualizar/{id}/{estatus}", name="cea_servicios_actualizar")
     * @Method({"GET", "POST"})
     */
    public function serviciosEditAction(DocenteServicio $servicios, $estatus)
    {
        
       $servicio = $this->getDoctrine()->getRepository('AppBundle:DocenteServicio')->findOneById($servicios->getId());
       
       if($estatus == "true") {
           $servicio->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(1));           
                                            
       }else{
           $servicio->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(3));           
       }
           
       $em = $this->getDoctrine()->getManager();
       $em->persist($servicio);       
       $em->flush();
       
       $user = $this->getDoctrine()->getRepository('AppBundle:Usuarios')->findOneByIdRolInstitucion($servicio->getIdRolInstitucion());
       
       $message = \Swift_Message::newInstance()
                    ->setSubject('Resultado Adscripcion CEA@UBV')
                    ->setFrom('wilmer.ramones@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'correos/actualizar_adscripcion.html.twig',
                            array(    
                                'nombres'  => $user->getUserName(),
                                'estatus'   => $servicio->getIdEstatus()
                            )
                        ),
                        'text/html'
                    )                    
                ;
                $this->get('mailer')->send($message);
       
       $this->addFlash('notice', 'Servicio Actualizada Correctamente, hemos enviado un correo al docente notificandole los cambios.');
       
       $escala = $this->getDoctrine()->getRepository('AppBundle:DocenteEscala')->findOneBy(array(
                'idRolInstitucion' => $servicio->getIdRolInstitucion(),
                 'idTipoEscala'   => 1
        ));
       
       $adscripcion = $this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findOneByIdRolInstitucion($servicio->getIdRolInstitucion());
        return $this->render('cea/servicios_mostar.html.twig', array(
            'servicio' => $servicio,
            'oposicion' => $escala,
            'adscripcion' => $adscripcion
        ));
       
    }
        
    
    /**
     * Muestra la página donde explica brevemente el reconocimiento de Antiguedad
     * y permite realizar la solicitud
     *
     * @Route("/solicitudes/antiguedad/", name="cea_solicitudes_recocimiento_antiguedad")
     * @Method({"GET", "POST"})
     */
    public function solicitudesAntiguedadIndexAction(){
        
        $servicio = $this->getDoctrine()->getRepository('AppBundle:DocenteServicio')->findOneByIdRolInstitucion($this->getUser()->getIdRolInstitucion());
        
        if(!$servicio){
                return $this->render('solicitudes/reconocimiento_antiguedad.html.twig');
        }else{
            $this->addFlash('notice', 'Ya usted ha realizado la solicitud de reconocimiento de antiguedad.');
            return $this->redirect($this->generateUrl('servicios_index'));   
        }
        
        
        
    }
    
    
    /**
     * Muestra la página donde explica brevemente el reconocimiento de Antiguedad
     * y permite realizar la solicitud
     *
     * @Route("/mis_servicios/antiguedad/imprimir", name="servicio_antiguedad_imprimir")
     * @Method({"GET", "POST"})
     */
    public function solicitudesAntiguedadImprimirAction(){
        
       return $this->render('memorando/antiguedad.html.twig');
        
        
        
    }
    
    
    
    
     /**
     * Muestra la página donde explica brevemente el reconocimiento de Antiguedad
     * y permite realizar la solicitud
     *
     * @Route("/solicitudes/antiguedad/crear/", name="cea_crear_servicio_antiguedad")
     * @Method({"GET", "POST"})
     */
    public function solicitudesAntiguedadCrearAction(){
        
        $servicios = new DocenteServicio();
        
        $servicios->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
        $servicios->setIdServicioCe($this->getDoctrine()->getRepository('AppBundle:ServiciosCe')->findOneById(1));
        $servicios->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:estatus')->findOneById(2));
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($servicios);
        $em->flush();
        
        $this->addFlash('notice', 'Solicitud Creada Correctamente, en lo que la solicitud sea aprobada, se le notificará por correo.');
        
        return $this->render('solicitudes/reconocimiento_antiguedad.html.twig');
        
    }
    
    
    
}
 