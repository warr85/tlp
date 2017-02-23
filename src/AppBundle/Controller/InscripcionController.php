<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Inscripcion;
use AppBundle\Entity\CursoAvance;
use AppBundle\Entity\Suscripcion;


/**
 * Inscripcion controller.
 *
 * @Route("/curso/comprar")
 */
class InscripcionController extends Controller
{
    /**
     * Lists all Inscripcion entities.
     *
     * @Route("/", name="curso_comprar_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inscripcions = $em->getRepository('AppBundle:Inscripcion')->findAll();

        return $this->render('inscripcion/index.html.twig', array(
            'inscripcions' => $inscripcions,
        ));
    }

    /**
     * Creates a new Inscripcion entity.
     *
     * @Route("/new", name="curso_comprar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $inscripcion = new Inscripcion();
        $avance = new CursoAvance();
        $suscripcion = new Suscripcion();
        
        $form = $this->createForm('AppBundle\Form\InscripcionType', $inscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $inscripcion->setIdUsuario($this->getUser());
            $avance->setIdInscripcion($inscripcion);
            $avance->setIdEstatus($this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(1));
            $curso = $inscripcion->getIdCursoGrupo()->getIdCurso();
            $cursoModulo = $this->getDoctrine()->getRepository('AppBundle:CursoModulo')->findOneBy(array(               
                'idCurso'   => $curso,
                'orden'     => 1
            ));
            $cursoModuloTemas = $this->getDoctrine()->getRepository('AppBundle:CursoModuloTema')->findOneBy(array(
               'idCursoModulo'  => $cursoModulo,
                'orden'         => 1
            ));
            $avance->setIdCursoModuloTema($cursoModuloTemas);
            $avance->setFechaAvance(new \DateTime());
            $inscripcion->setFechaInscripcion(new \DateTime());

            $suscripcion->setIdInscripcion($inscripcion);
            $suscripcion->setIdEstatus($em->getRepository('AppBundle:Estatus')->findOneById(2));
            $suscripcion->setIdCostoCursoModulo($cursoModulo->getIdCostoCursoModulo());
            $suscripcion->setIdFormaPago($em->getRepository('AppBundle:FormaPago')->findOneById(1));
            
            $em->persist($avance);
            $em->persist($suscripcion);
            $em->persist($inscripcion);
                           
            $em->flush();
            
            

            return $this->redirectToRoute('curso_comprar_show', array('id' => $inscripcion->getId()));
        }

        return $this->render('inscripcion/new.html.twig', array(
            'inscripcion' => $inscripcion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Inscripcion entity.
     *
     * @Route("/{id}", name="curso_comprar_show")
     * @Method("GET")
     */
    public function showAction(Inscripcion $inscripcion)
    {
        $deleteForm = $this->createDeleteForm($inscripcion);

        return $this->render('inscripcion/show.html.twig', array(
            'inscripcion' => $inscripcion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     * @Route("/{id}/edit", name="curso_comprar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Inscripcion $inscripcion)
    {
        $deleteForm = $this->createDeleteForm($inscripcion);
        $editForm = $this->createForm('AppBundle\Form\InscripcionType', $inscripcion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscripcion);
            $em->flush();

            return $this->redirectToRoute('curso_comprar_edit', array('id' => $inscripcion->getId()));
        }

        return $this->render('inscripcion/edit.html.twig', array(
            'inscripcion' => $inscripcion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing Suscripcion entity.
     *
     * @Route("/suscripcion/{id}", name="suscripcion_show")
     * @Method({"GET", "POST"})
     */
    public function showSuscripcionAction( Suscripcion $suscripcion)
    {
        $form = $this->createForm('AppBundle\Form\SuscripcionType');
        return $this->render('suscripcion/show.html.twig', array(
            'suscripcion'   => $suscripcion,
            'form'          => $form->createView()
        ));
    }



    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     * @Route("/suscripcion/{id}/edit", name="suscripcion_edit")
     * @Method({"GET", "POST"})
     */
    public function editSuscripcionAction(Request $request, Suscripcion $suscripcion)
    {

        $editForm = $this->createForm('AppBundle\Form\SuscripcionType', $suscripcion);
        $editForm->handleRequest($request);
        //var_dump($editForm->isValid()); exit;
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $suscripcion->setIdEstatus($this->getDoctrine()->getRepository("AppBundle:Estatus")->findOneById(6));
            $em = $this->getDoctrine()->getManager();
            $em->persist($suscripcion);
            $em->flush();

            return $this->redirectToRoute('estudiante_homepage');
        }

        return $this->render('suscripcion/show.html.twig', array(
            'suscripcion' => $suscripcion,
            'form' => $editForm->createView(),
        ));
    }


    /**
     * Deletes a Inscripcion entity.
     *
     * @Route("/{id}", name="curso_comprar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Inscripcion $inscripcion)
    {
        $form = $this->createDeleteForm($inscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inscripcion);
            $em->flush();
        }

        return $this->redirectToRoute('curso_comprar_index');
    }

    /**
     * Creates a form to delete a Inscripcion entity.
     *
     * @param Inscripcion $inscripcion The Inscripcion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inscripcion $inscripcion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curso_comprar_delete', array('id' => $inscripcion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
