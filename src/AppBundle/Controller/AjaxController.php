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
use AppBundle\Entity\CursoAvance;
use AppBundle\Entity\CursoAvanceEvaluacion;
use AppBundle\Entity\CursoAvanceEvaluacionResultado;

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
    
    
    /**
     * @Route("/avance", name="ajax_avance")
     * @Method({"GET"})
     */
    public function registrarAvanceAction(Request $request){
        if($request->isXmlHttpRequest()){
            
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
 
            $serializer = new Serializer($normalizers, $encoders);
 
            $em = $this->getDoctrine()->getManager();
            $parametros = $this->getRequest()->query->all();
            
            $avance = $em->getRepository("AppBundle:CursoAvance")->findOneBy(array(
               'idInscripcion'      => $parametros['inscripcion'],
               'idEstatus'          =>  1,
               'idCursoModuloTema'  => $parametros['tema']
            ));
            
            if($avance){
            
                $avance->setIdEstatus($em->getRepository("AppBundle:Estatus")->findOneById(4));


                $Navance = new CursoAvance();
                $nuevoTema = $em->getRepository("AppBundle:CursoModuloTema")->findOneById($avance->getIdCursoModuloTema()->getId() + 1);            
                $Navance->setFechaAvance(new \DateTime());
                $Navance->setIdCursoModuloTema($nuevoTema);
                $Navance->setIdEstatus($em->getRepository("AppBundle:Estatus")->findOneById(1));
                $Navance->setIdInscripcion($inscripcion = $em->getRepository("AppBundle:Inscripcion")->findOneById($parametros['inscripcion']));

                $em->persist($avance);
                $em->persist($Navance);
                $em->flush();
            }
            
            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',                
            ));
            return $response;
        }
    }
    
    
    
    /**
     * @Route("/evaluacion", name="ajax_evaluacion")
     * @Method({"GET"})
     */
    public function registrarEvluacionAction(Request $request){
        if($request->isXmlHttpRequest()){
            
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
 
            $serializer = new Serializer($normalizers, $encoders);
 
            $em = $this->getDoctrine()->getManager();
            $parametros = $this->getRequest()->query->all();
            
            $avance = $em->getRepository("AppBundle:CursoAvance")->findOneByIdCursoModuloTema($parametros['tema']);
            $evaluacion = $em->getRepository("AppBundle:CursoAvanceEvaluacion")->findOneByIdCursoAvance($avance);
            $idCursoModuloTemaEvaluacion = $em->getRepository("AppBundle:CursoModuloTemaEvaluacion")->findOneByIdCursoModuloTema($parametros["tema"]);
            if(!$evaluacion){
                $evaluacion = new CursoAvanceEvaluacion();
                $evaluacion->setIdCursoAvance($avance);
                $evaluacion->setIdCursoModuloTemaEvaluacion($idCursoModuloTemaEvaluacion);
                $evaluacion->setIdEstatus($em->getRepository("AppBundle:Estatus")->findOneById(4));                
                $em->persist($evaluacion);                             
            }
            
            $resultado = new CursoAvanceEvaluacionResultado();
            $resultado->setFechaResultado(new \DateTime());
            $resultado->setIdCursoAvanceEvaluacion($evaluacion);
            $resultado->setIdEstatus($evaluacion->getIdEstatus());
            $resultado->setResultado($parametros['score']);
            
            
            
            $em->persist($resultado);            
            $em->flush();
            
            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',                
            ));
            return $response;
        }
    }
    
    
    /**
     * @Route("/console", name="ajax_console")
     * @Method({"GET"})
     */
    public function consoleAction(Request $request){
        
        if($request->isXmlHttpRequest()){
            
            /**
             * array of allowed commands. Default: empty array (all are allowed)
             * You can use * for any symbol.
             * Example: "branch*" will allow both "branch" and "branch -v" commands
             */
            $allow = array();

            /**
             * array of denied commands. Default: empty array (none is denied)
             * You can use * for any symbol.
             */
            $deny = array(
                "rm*",
                "sudo*",
                "apt*"
            );
            
            
             
            
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
 
            $serializer = new Serializer($normalizers, $encoders);
 
            $em = $this->getDoctrine()->getManager();
            $parametros = $this->getRequest()->query->all();
            
            $currentDir = $parametros['cd'];
            $allowChangeDir = true;           
            
            $userCommand = urldecode($parametros['command']);
            $userCommand = escapeshellcmd($userCommand);
            
            
            
            $commands = array(
                'git*' => $this->container->getParameter('git_directory') . 'git $1',
                'composer*' => '/usr/local/bin/composer $1',
                'symfony*' => './app/console $1',
                '*' => '$1', // Allow any command. Must be at the end of the list.
            );
            
            $response = new JsonResponse();
            $response->setStatusCode(200);
            
            if (!empty($allow)) {
                if (!searchCommand($userCommand, $allow)) {
                    $these = implode('<br>', $allow);
                    $error = "<span class='error'>Sorry, but this command not allowed. Try these:<br>{$these}</span>\n";
                    $response->setData(array(
                        'response'      => 'success',
                        'parametros'    => $userCommand,
                        'error'         => $error,                       
                    ));
                    return $response;
                }
            }

            // Check command by deny list.
            if (!empty($deny)) {
                //var_dump($deny); exit;
                if (searchCommand($userCommand, $deny)) {
                    $error = "<span class='error'>Lo sentimos, pero este comando no está permitido.</span>\n";
                    $response->setData(array(
                        'response'      => 'success',
                        'parametros'    => $userCommand,
                        'error'         => $error,
                        'salida'        => ""
                    ));
                    return $response;
                }
            }
            
            if ($allowChangeDir && 1 === preg_match('/^cd\s+(?<path>.+?)$/i', $userCommand, $matches)) {
                
                
                $newDir = $matches['path']; 
                if($newDir[0] === '/'){
                    $salida = "<span class='error'>cd: $newDir: No podemos ir a ese directorio, permiso denegado.</span>\n";
                    $response->setData(array(
                        'response'      => 'success',
                        'parametros'    => $userCommand,
                        'error'         => $salida, 
                        'salida'        => ""
                    ));
                    return $response; 
                }
                if($newDir === '..'){
                    $exploded = explode("/", $currentDir);
                    $last = array_pop($exploded);
                    if($last === $parametros['user']){
                        $salida = "<span class='error'>cd: $newDir: No podemos salir de tu directorio de usuario, permiso denegado.</span>\n";
                        $response->setData(array(
                            'response'      => 'success',
                            'parametros'    => $userCommand,
                            'error'         => $salida, 
                            'salida'        => ""
                        ));
                        return $response;
                    }
                }
                $newDir = $currentDir . '/' . $newDir;
                           
                if (is_dir($newDir)) {
                    $newDir = realpath($newDir);
                    // Interface will recognize this and save as current dir.
                    $salida = "set current directory $newDir";
                    $response->setData(array(
                        'response'      => 'success',
                        'parametros'    => $userCommand,
                        'salida'         => $salida,                       
                    ));
                    return $response;                    
                } else {
                    $salida = "<span class='error'>cd: $newDir: No such directory.</span>\n";
                    $response->setData(array(
                        'response'      => 'success',
                        'parametros'    => $userCommand,
                        'salida'         => $salida,                       
                    ));
                    return $response;  
                }
            }
            
            
            $comando = $userCommand;
            $original = $userCommand;
            if (strpos($comando, '--global') !== false) {
                
                $userCommand = str_replace("--global", "", $comando);                
            }
            if(substr( $comando, 0, 3 ) === "git"){
                if(ComandoToca($comando, $parametros['comandos'])){
                    $userCommand = $this->container->getParameter('git_directory') . $comando;
                }else{
                    
                    $response->setData(array(
                        'response'      => 'error',
                        'parametros'    => $userCommand,
                        'error'         => "<span class='error'>Este Comando " . $userCommand . " Todavía no toca utilizarlo</span>",
                        'salida'        => ""
                    ));
                    return $response;
                    
                }
            }
            
            
            $userCommand = "cd $currentDir && $userCommand";
            
            $descriptors = array(
                0 => array("pipe", "r"), // stdin - read channel
                1 => array("pipe", "w"), // stdout - write channel
                2 => array("pipe", "w"), // stdout - error channel
                3 => array("pipe", "r"), // stdin - This is the pipe we can feed the password into
            );

    $process = proc_open($userCommand, $descriptors, $pipes);

    if (!is_resource($process)) {
        die("Can't open resource with proc_open.");
    }

    // Nothing to push to input.
    fclose($pipes[0]);

    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $error = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    // TODO: Write passphrase in pipes[3].
    fclose($pipes[3]);

    // Close all pipes before proc_close!
    $code = proc_close($process);

    
            
            //var_dump($parametros); exit;
                        
            $response->setData(array(
                'response'      => 'success',
                'parametros'    => $userCommand,
                'salida'        => $output,
                'error'         => $error,
                'code'          => $code,
                'comando'       => $original
            ));
            return $response;
        }
        
        
    }
    
    
    
}


function searchCommand($userCommand, array $commands, &$found = false, $inValues = true)
{
    foreach ($commands as $key => $value) {
        list($pattern, $format) = $inValues ? array($value, '$1') : array($key, $value);
        $pattern = '/^' . str_replace('\*', '(.*?)', preg_quote($pattern)) . '$/i';
        if (preg_match($pattern, $userCommand)) {
            if (false !== $found) {
                $found = preg_replace($pattern, $format, $userCommand);
            }
            return true;
        }
    }
    return false;
}


function ComandoToca($userCommand, array $orden)
{    
    foreach ($orden as $key => $value) {   
       if ($value === 'false'){             
           if (strpos($userCommand, $key) !== false){ return true; }
           else {return false; }
       }else if ($value === 'true'){
           if (strpos($userCommand, $key) !== false){ return true; }
       }
    }    
    return false;
}

