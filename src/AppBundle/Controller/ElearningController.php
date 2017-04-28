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
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;


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
        $currentLevel = $this->getDoctrine()->getRepository("AppBundle:CursoNivel")->findOneById($this->getUser()->getIdCursoNivel()->getId());
        $proximoNivel = $this->getDoctrine()->getRepository("AppBundle:CursoNivel")->findOneById($currentLevel->getId() + 1);
        $ppn = round((($this->getUser()->getExperiencia() - $this->getUser()->getIdCursoNivel()->getExperienciaNecesaria()) * 100) / ($proximoNivel->getExperienciaNecesaria() - 1),0) ;
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
            'cuenta'        => $cuenta,
            'porcentajePxNivel' => $ppn
        ));
        
    }
    
    
    /**
     * @param Inscripcion $inscripcion
     * @Route("/curso/programacion/{id}/reto/{avance}", name="estudiante_curso_programacion")
     * @return Response
     */
    public function cursoProgramacionAction(Inscripcion $inscripcion, $avance ){

        $tema = $inscripcion->getAvances()->first();
        //echo $this->getUser()->getIdCursoNivel()->getId(); exit;
        $currentLevel = $this->getDoctrine()->getRepository("AppBundle:CursoNivel")->findOneById($this->getUser()->getIdCursoNivel()->getId());
        $proximoNivel = $this->getDoctrine()->getRepository("AppBundle:CursoNivel")->findOneById($currentLevel->getId() + 1);
        $em = $this->getDoctrine()->getManager();
        $cursoModulo = $em->getRepository('AppBundle:CursoModulo')->findOneByIdCurso($inscripcion->getIdCursoGrupo()->getIdCurso());
        $temaActual = $em->getRepository('AppBundle:CursoModuloTema')->findOneBy(array(
           'idCursoModulo'  => $cursoModulo,
            'orden'         => $avance
        ));

        $ppn = round((($this->getUser()->getExperiencia() - $this->getUser()->getIdCursoNivel()->getExperienciaNecesaria()) * 100) / ($proximoNivel->getExperienciaNecesaria() - 1),0) ;
        $logrosObtenidos = $em->getRepository("AppBundle:UsuariosLogros")->findBy(array(
            'idUsuario' => $this->getUser()->getId(),
            'idEstatus' => 5
        ));
        $logrosDisponibles = $em->getRepository("AppBundle:CursoModuloTemaLogro")->findBy(
            array("idCursoModuloTema" => $temaActual->getId()),
            array('id' => 'ASC')
        );


        // Manejador de Archivos
        $repositorio_git = false;
        $archivo_creado = false;
        $directorio_creado = false;
        $directorio = $this->container->getParameter('octonautas_directory') . $this->getUser()->getUserName();
        if(!file_exists($directorio) && !is_dir($directorio)){
            mkdir($directorio);
        }


        if ($handle = opendir($directorio)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry[] = readdir($handle))) {

            }

            closedir($handle);
        }
        $directorio_creado = false;
        $files = array();

        if($entry[0] != "." && $entry[0] != ".."){
            $directorio_creado = true;
            $proyect_dir = $directorio . "/" . $entry[0];
            if ($handle = opendir($proyect_dir )) {

                /* This is the correct way to loop over the directory. */
                while (false !== ($entry2[] = $current =  readdir($handle))) {
                    if($current == ".git"){
                        $repositorio_git = true;
                    }

                }
                closedir($handle);
                $files = scandir($proyect_dir);
            }
        }
        $cuenta = 0;
        $leeme_creado = false;
        $archivo12 = "false";
        foreach ($files as $archivo){
            if (stripos($archivo, 'leeme') !== false) {
                $leeme_creado = true;
            }
            if (stripos($archivo, 'archivo') !== false) {
                $cuenta ++;
                if($cuenta == 2) {
                    $archivo12 = true;
                }
            }
        }




        //var_dump($logrosObtenidos); exit;
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
            'currentDir'        => $directorio,
            'mkdir'             => $directorio_creado,
            'repositorio'       => $repositorio_git,
            'archivo'           => $leeme_creado,
            'archivo12'         => $archivo12,
            'porcentajePxNivel' => $ppn
        ));
        
    }
    
    
}
