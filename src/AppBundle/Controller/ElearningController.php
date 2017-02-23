<?php

/*
 * Copyright (C) 2016 Tecnolínea Paraguná C.A.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Inscripcion;
use Symfony\Component\HttpFoundation\Response;


/**
 * Description of ElearningController
 * Este controlador es el que gestiona el aprendizaje del estudiante
 * a lo largo de su vida con el curso que haya suscrito en la pagina del portal
 *
 * @author Tecnolínea Paraguná C.A.
 * 
 * @Route("/estudiante")
 */
class ElearningController extends Controller {
    
    /**
     * @Route("/", name="estudiante_homepage")
     * @return Response
     */
    public function indexAction(){


        $em = $this->getDoctrine()->getManager();

        $inscripcion = $em->getRepository('AppBundle:Inscripcion')->findBy(array(
           'idUsuario'  => $this->getUser() 
        ));

        if(!$inscripcion){
            $this->addFlash('warning', 'debes tener un curso inscrito para poder ingresar al área de estudiante');
            return $this->render('portal/index.html.twig');
        }


        //Para saber en que parte del curso se encuentra esta inscripcion
        $avance = $em->getRepository('AppBundle:CursoAvance')->findOneBy(array(
           'idInscripcion'  => $inscripcion,
            'idEstatus'     => 1            
        ));
        $notificaciones = 0; $cuenta = 0;
        return $this->render('estudiante/index.html.twig', array(
            'inscripciones' => $inscripcion,
            'avance'        => $avance,
            'notificaciones' => $notificaciones,
            'cuenta'        => $cuenta
        ));
        
    }
    
    
    /**
     * @param Inscripcion $inscripcion
     * @Route("/curso/programacion/{id}/reto/{avance}", name="estudiante_curso_programacion")
     * @return Response
     */
    public function cursoProgramacionAction(Inscripcion $inscripcion, $avance ){
        
        $tema = $inscripcion->getAvances()->first();
        $em = $this->getDoctrine()->getManager();
        $cursoModulo = $em->getRepository('AppBundle:CursoModulo')->findOneByIdCurso($inscripcion->getIdCursoGrupo()->getIdCurso());
        $temaActual = $em->getRepository('AppBundle:CursoModuloTema')->findOneBy(array(
           'idCursoModulo'  => $cursoModulo,
            'orden'         => $avance
        ));
                
        $logrosObtenidos = $em->getRepository("AppBundle:UsuariosLogros")->findByIdEstatus(5);
        $logrosDisponibles = $em->getRepository("AppBundle:CursoModuloTemaLogro")->findBy(
            array("idCursoModuloTema" => $temaActual->getId()),
            array('id' => 'ASC')
        );
        $directorio = $this->container->getParameter('octonautas_directory') . $this->getUser()->getUserName();            
        if(!file_exists($directorio)){
            mkdir($directorio);
        }
        return $this->render('elearning/' . $inscripcion->getIdCursoGrupo()->getIdCurso()->getNombreCorto() . '/' . $avance .  '.html.twig', array(
            'inscripcion'       => $inscripcion,
            'cursoModulo'       => $cursoModulo,
            'avance'            => $avance,
            'temaActual'        => $temaActual,
            'temaCurso'         => $tema->getIdCursoModuloTema(),
            'logrosDisponibles' => $logrosDisponibles,
            'logrosObtenidos'   => $logrosObtenidos,   
            'currentDirName'    => "octonauta",
            'currentUser'       => $this->getUser()->getUserName(),
            'currentDir'        => $directorio     
        ));
        
    }
    
    
}
