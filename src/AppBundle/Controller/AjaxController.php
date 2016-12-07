<?php

/*
 * Copyright (C) 2016 ubv-cipee
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
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use AppBundle\Entity\InscripcionLogro;

/**
 * Description of AjaxController
 *
 * @author ubv-cipee
 * @Route("/ajax")
 */
class AjaxController extends Controller {
    
    /**
     * @Route("/progreso", name="ajax_progreso")
     * @Method({"GET"})
     */
    public function registrarProgresoAction(Request $request){
        
        if($request->isXmlHttpRequest()){
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
 
            $serializer = new Serializer($normalizers, $encoders);
 
            $em = $this->getDoctrine()->getManager();
            $parametros = $this->getRequest()->query->all();
            //var_dump($parametros); exit;
            $logro = $em->getRepository("AppBundle:InscripcionLogro")->findOneByIdCursoModuloTemaLogro($parametros['logro']);
            if(!$logro ){

                $inscripcion = $em->getRepository("AppBundle:Inscripcion")->findOneById($parametros['inscripcion']);
                $logro = new InscripcionLogro();
                $logro->setContador(1);
                $logro->setFechaActualizacion(new \DateTime);
                $logro->setFechaLogro(new \DateTime);  
                $logro->setIdInscripcion($inscripcion);
                $logro->setIdCursoModuloTemaLogro($em->getRepository("AppBundle:CursoModuloTemaLogro")->findOneById($parametros['logro']));               
            }else{
               $cuenta = $logro->getContador();
               $cuenta++;
               $logro->setContador($cuenta);
               $logro->setFechaActualizacion(new \DateTime);
            }            
            $em->persist($logro);
            $em->flush();
                                
            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',                
            ));
            return $response;
       }
        
    }
    
}
