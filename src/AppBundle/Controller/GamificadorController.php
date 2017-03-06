<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UsuariosLogros;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Gamificador controller.
 *
 * @Route("/admin/gestion/gamificacion")
 */
class GamificadorController extends Controller
{
    /**
     * Lists all Curso entities.
     *
     * @Route("/", name="admin_gestion_gamaficacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $niveles = $em->getRepository('AppBundle:CursoNivel')->findAll();

        return $this->render('gamificacion/index.html.twig', array(
            'niveles' => $niveles,
        ));
    }

    /**
     * Creates un nuevo nivel para los cursos
     *
     * @Route("/nuevo_nivel", name="admin_gestion_gamificacion_nuevo_nivel")
     * @Method({"GET", "POST"})
     */
    public function newLevelAction(Request $request)
    {
        $curso = new Curso();
        $form = $this->createForm('AppBundle\Form\CursoType', $curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_cursos_show', array('id' => $curso->getId()));
        }

        return $this->render('curso/new.html.twig', array(
            'curso' => $curso,
            'form' => $form->createView(),
        ));
    }
    
    
    
    /**
     * Creates un nuevo nivel para los cursos
     *
     * @Route("/add_experience", name="gamificacion_add_xp")
     * @Method({"GET", "POST"})
     */
    public function addExperienceAction(Request $request)
    {
        $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
 
            $serializer = new Serializer($normalizers, $encoders);
        $usuario = $this->getDoctrine()->getRepository("AppBundle:Usuarios")->findOneById($this->getUser());
        if($usuario){
            $parametros = $request->query->all();
            $exp = $parametros['experience'];
            
            $exp += $usuario->getExperiencia();

            $qb = $this->getDoctrine()->getManager();

            $qb = $qb->createQueryBuilder();
            $qb->select('MAX(cn.experienciaNecesaria)');
            $qb->from('AppBundle:CursoNivel', 'cn');
            $qb->where('cn.experienciaNecesaria <= :exp')->setParameter('exp', $exp);

            $nivel = $qb->getQuery()->getSingleResult();

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:CursoNivel');
            $query = $repository->createQueryBuilder('cn')
                ->where('cn.experienciaNecesaria = :act')
                ->setParameter('act', $nivel[1])
                ->orderBy('cn.id', 'ASC')
                ->getQuery();


            $nivel = $query->getSingleResult();





            if(!$usuario->getIdCursoNivel()){
                $usuario->setIdCursoNivel($nivel);
                $usuario->setExperiencia($exp);
            }else {
                if (($nivel) && ($nivel->getNombre() != $usuario->getIdCursoNivel()->getNombre())) {
                    $usuario->setIdCursoNivel($nivel);
                    $usuario->setExperiencia($exp);
                } else {
                    $usuario->setExperiencia($exp);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
            
            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success'
            ));
            return $response;
            
            
        }

        $response = new JsonResponse();
        $response->setStatusCode(200);
        $response->setData(array(
            'response' => 'no existe inscripcion',                
        ));
        return $response;
    }
    
    
    
    /**
     * @Route("/add_logro/{cantidad}", name="gamificacion_add_logro")
     * @Method({"GET"})
     */
    public function addLogroAction($cantidad = 1, Request $request){
        
        
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $em = $this->getDoctrine()->getManager();
        $serializer = new Serializer($normalizers, $encoders);
        $response = new JsonResponse();
        $usuario = $this->getDoctrine()->getRepository("AppBundle:Usuarios")->findOneById($this->getUser());
            if($usuario){
                $parametros = $request->query->all();
                $corto = $parametros["corto"];
                $badge = $parametros["badge"];
                $bg = "bg_logro.png";
                $image =  '../../../../../../images/badge/'  . $badge;
                $fondo = '../../../../../../images/course/' . $bg;
               // $corto = "conceptos";
                $logros = $this->getDoctrine()->getRepository("AppBundle:CursoModuloTemaLogro")->findOneByNombreCorto($corto);                
                if($logros){                    
                    if($logros->getIdEstatus()->getId() == 1){
                        $now = time();
                        $insLogro = $this->getDoctrine()->getRepository("AppBundle:UsuariosLogros")->findOneBy(array(
                            'idUsuario' => $usuario->getId(),
                            'idCursoModuloTemaLogro'       => $logros->getId()
                        ));
                        
                        if($insLogro){
                            if($insLogro->getIdEstatus()->getId() == 1){
                                $cantidad += $insLogro->getContador();
                                if($now >= $insLogro->getUltimaVez() + $logros->getPeriodoTiempo()){
                                    if($cantidad >= $logros->getCantidadNecesaria()){
                                        $insLogro->setIdEstatus($this->getDoctrine()->getRepository("AppBundle:Estatus")->findOneById(5));
                                        $insLogro->setContador($cantidad);
                                        $response->setData(array(
                                            'response' => 'success',
                                            'complete'  => true,
                                            'background' => $fondo,
                                            'badge' =>  $image
                                        ));
                                    }else{
                                        $insLogro->setContador($cantidad);
                                        $response->setData(array(
                                            'response' => 'success',
                                            'complete'  => false,
                                         ));
                                    }
                                    
                                    $em->persist($insLogro);
                                    $em->flush();
                                    
                                    $response->setStatusCode(200);
                                    return $response;
                                }else{
                                   $response->setData(array(
                                        'response' => 'seguidilla',
                                        'complete'  => false
                                    )); 
                                    return $response;
                                    
                                }
                                
                            }else{
                                $response->setData(array(
                                    'response' => 'done'
                                 ));
                                return $response;
                            }
                        }else{

                            $insLogro = new UsuariosLogros();
                            $insLogro->setContador($cantidad);
                            $insLogro->setIdCursoModuloTemaLogro($logros);
                            if($cantidad >= $logros->getCantidadNecesaria()){
                                $insLogro->setIdEstatus($this->getDoctrine()->getRepository("AppBundle:Estatus")->findOneById(5));        
                                $response->setData(array(
                                    'response' => 'success',
                                    'complete'  => true,
                                    'background' => $fondo,
                                    'badge' =>  $image
                                 ));
                            }else{
                                $insLogro->setIdEstatus($this->getDoctrine()->getRepository("AppBundle:Estatus")->findOneById(1));        
                                $response->setData(array(
                                    'response' => 'success',
                                    'complete'  => false
                                 ));
                            }
                            $insLogro->setIdUsuario($usuario);
                            $insLogro->setUltimaVez($now);
                            
                            $em->persist($insLogro);
                            $em->flush();
                            return $response;
                        }
                    }
                }                                
                return $response;
            }
        
        
    }
    
    
    
    
    
    
    
    

    /**
     * Finds and displays a Curso entity.
     *
     * @Route("/{id}", name="admin_gestion_cursos_show")
     * @Method("GET")
     */
    public function showAction(Curso $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);

        return $this->render('curso/show.html.twig', array(
            'curso' => $curso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Curso entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_cursos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Curso $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);
        $editForm = $this->createForm('AppBundle\Form\CursoType', $curso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_cursos_edit', array('id' => $curso->getId()));
        }

        return $this->render('curso/edit.html.twig', array(
            'curso' => $curso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Curso entity.
     *
     * @Route("/{id}", name="admin_gestion_cursos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Curso $curso)
    {
        $form = $this->createDeleteForm($curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($curso);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_cursos_index');
    }

    /**
     * Creates a form to delete a Curso entity.
     *
     * @param Curso $curso The Curso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Curso $curso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_cursos_delete', array('id' => $curso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
