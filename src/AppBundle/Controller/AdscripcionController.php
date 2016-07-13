<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 09:08 AM
 */

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Adscripcion;
use AppBundle\Entity\DocenteEscala;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdscripcionController extends Controller
{
    /**
     * @Route("/solicitud/adscripcion", name="solicitud_adscripcion")
     */
    public function registerAction(Request $request)
    {
        //si ya se adscribió redirigirlo a la página principal del sistema
        if($this->getDoctrine()->getRepository('AppBundle:Adscripcion')->findOneByIdRolInstitucion($this->getUser()->getIdRolInstitucion()->getId())){
            return $this->redirect($this->generateUrl('cea_index'));
        }


	    $adscripcion = new Adscripcion();
	    $escala = new DocenteEscala();

        /** @var TYPE_NAME $form */
        $form = $this->createForm('AppBundle\Form\UserType');
	    $form->handleRequest($request);

        $form->get('escala')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
        	  //var_dump($form->get('lineas_investigacion')->getData()); exit;

		 // $file stores the uploaded PDF file
            /** @var UploadedFile $constanciaTrabajo */
            $constanciaTrabajo = $form->get('trabajo')->getData();
            /** @var UploadedFile $constanciaPregrado */
            $constanciaPregrado = $form->get('pregrado')->getData();
            
            

            // Generate a unique name for the file before saving it
            $nombreTrabajo = md5(uniqid()).'.'.$constanciaTrabajo->guessExtension();
            

            // Move the file to the directory where brochures are stored
            $constanciaTrabajo->move(
                $this->container->getParameter('adscripcion_directory'),
                $nombreTrabajo
            );            
            thumbnail($nombreTrabajo, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
             
            $nombrePregrado = md5(uniqid()).'.'.$constanciaPregrado->guessExtension();
             $constanciaPregrado->move(
                $this->container->getParameter('adscripcion_directory'),
                $nombrePregrado
            );
            thumbnail($nombrePregrado, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
            
            if($form->get('postgrado')->getData()) {
                /** @var UploadedFile $constanciaPostgrado */
            	$constanciaPostgrado = $form->get('postgrado')->getData();
            	$nombrePostgrado = md5(uniqid()).'.'.$constanciaPostgrado->guessExtension();
            	$constanciaPostgrado->move(
                	$this->container->getParameter('adscripcion_directory'),
                	$nombrePostgrado
            	);
                thumbnail($nombrePostgrado, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                $adscripcion->setPostgrado($nombrePostgrado);
            }
            $em = $this->getDoctrine()->getManager();

            $adscripcion->setTrabajo($nombreTrabajo);
            $adscripcion->setPregrado($nombrePregrado);            
            $adscripcion->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
            $adscripcion->setFechaIngreso($form->get('fecha_ingreso')->getData());
            $adscripcion->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(2));


            if ($form->get('escala')->getData()){
                $escala->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                $escala->setFechaEscala($form->get('fecha_oposicion')->getData());
                $escala->setIdEscala($form->get('escala')->getData());
                $escala->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(1));
                $em->persist($escala);

                if($form->get('documento_oposicion')->getData()) {
                    $constanciaOposicion = $form->get('documento_oposicion')->getData();
                    $nombreOposicion = md5(uniqid()).'.'.$constanciaOposicion->guessExtension();
                    $constanciaOposicion->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreOposicion
                    );
                    thumbnail($nombreOposicion, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                    $adscripcion->setOposicion($nombreOposicion);
                    $adscripcion->setIdLineaInvestigacion($form->get('lineas_investigacion')->getData());
                    $adscripcion->setTituloTrabajo($form->get('titulo_trabajo')->getData());
                }




                if ($form->get('documento_asistente')->getData()) {
                    $escala2 = new DocenteEscala();
                    $asistente = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(2);
                    $escala2->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala2->setFechaEscala($form->get('fecha_ascenso_asistente')->getData());
                    $escala2->setIdEscala($asistente);
                    $escala2->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala2);

                    $constanciaAsistente = $form->get('documento_asistente')->getData();
                    $nombreAsistente = md5(uniqid()).'.'.$constanciaAsistente->guessExtension();
                    $constanciaAsistente->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreAsistente
                    );
                    thumbnail($nombreAsistente, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                    $adscripcion->setAsistente($nombreAsistente);


                }

               if ($form->get('documento_asociado')->getData()) {
                    $escala3 = new DocenteEscala();
                    $asociado = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(3);
                    $escala3->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala3->setFechaEscala($form->get('fecha_ascenso_asociado')->getData());
                    $escala3->setIdEscala($asociado);
                    $escala3->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala3);

                   $constanciaAsociado = $form->get('documento_asociado')->getData();
                   $nombreAsociado = md5(uniqid()).'.'.$constanciaAsociado->guessExtension();
                   $constanciaAsociado->move(
                       $this->container->getParameter('adscripcion_directory'),
                       $nombreAsociado
                   );
                   thumbnail($nombreAsociado, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                   $adscripcion->setAsociado($nombreAsociado);
                }


                if ($form->get('documento_agregado')->getData()) {
                    $escala4 = new DocenteEscala();
                    $agregado = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(4);
                    $escala4->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala4->setFechaEscala($form->get('fecha_ascenso_agregado')->getData());
                    $escala4->setIdEscala($agregado);
                    $escala4->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala4);

                    $constanciaAgregado = $form->get('documento_agregado')->getData();
                    $nombreAgregado = md5(uniqid()).'.'.$constanciaAgregado->guessExtension();
                    $constanciaAgregado->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreAgregado
                    );
                    thumbnail($nombreAgregado, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                    $adscripcion->setAgreado($nombreAgregado);
                }


                if ($form->get('documento_titular')->getData()) {
                    $escala5 = new DocenteEscala();
                    $titular = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(5);
                    $escala5->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala5->setFechaEscala($form->get('fecha_ascenso_titular')->getData());
                    $escala5->setIdEscala($titular);
                    $escala5->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala5);

                    $constanciaTitular = $form->get('documento_titular')->getData();
                    $nombreTitular = md5(uniqid()).'.'.$constanciaTitular->guessExtension();
                    $constanciaTitular->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreTitular
                    );
                    thumbnail($nombreTitular, $this->container->getParameter('adscripcion_directory'), $this->container->getParameter('adscripcion_thumb_directory'));
                    $adscripcion->setTitular($nombreTitular);
                }

            }

            $em->persist($adscripcion);

            
            $em->flush(); //guarda en la base de datos
            

            

            return $this->redirect($this->generateUrl('cea_index'));	
        }

        return $this->render(
            'solicitudes/adscripcion.html.twig',
            array('form' => $form->createView())
        );
    }
    
    
    /**
     * Muestra las Solicitudes de Adscripción.  Por defecto las creadas (estatus = 2)
     *
     * @Route("/solicitudes/adscripcion/{estatus}", name="cea_adscripciones")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_COORDINADOR')")
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
     * @Security("has_role('ROLE_COORDINADOR')")
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
     * @Security("has_role('ROLE_COORDINADOR')")
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
    
    
    
}

/*funcion para crear miniaturas de las imagenes y carga más rapido la página */

function thumbnail ($filename, $fuente, $destino){   
     if(preg_match('/[.](jpeg)$/', $filename)) {
        $im = imagecreatefromjpeg($fuente . "/" . $filename);
    } else if (preg_match('/[.](jpg)$/', $filename)) {
        $im = imagecreatefromjpeg($fuente . "/" . $filename);
    }else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif($fuente . "/" . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng($fuente . "/" . $filename);
    }

    $ox = imagesx($im);
    $oy = imagesy($im);

    $nx = 80;
    $ny = 80;

    $nm = imagecreatetruecolor($nx, $ny);

    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

    imagejpeg($nm, $destino . "/" . $filename);
}
