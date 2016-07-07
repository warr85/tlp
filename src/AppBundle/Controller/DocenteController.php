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

/**
 * Description of DocenteController
 *
 * @author ubv-cipee
 *
 * @Route("/ceapp")
 * 
 */
 
class DocenteController extends Controller {

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
     * @Route("/solicitudes", name="cea_solicitudes")
     * @Method("GET")
     */
    public function SolicitudesAction()
    {
  
        
        return $this->render('cea/solicitudes.html.twig');
    }
    
}
