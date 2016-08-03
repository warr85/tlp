<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoModuloTemaEvaluacion;
use AppBundle\Form\CursoModuloTemaEvaluacionType;

/**
 * CursoModuloTemaEvaluacion controller.
 *
 * @Route("/admin/gestion/tema_evaluaciones")
 */
class CursoModuloTemaEvaluacionController extends Controller
{
    /**
     * Lists all CursoModuloTemaEvaluacion entities.
     *
     * @Route("/", name="admin_gestion_tema_evaluaciones_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoModuloTemaEvaluacions = $em->getRepository('AppBundle:CursoModuloTemaEvaluacion')->findAll();

        return $this->render('cursomodulotemaevaluacion/index.html.twig', array(
            'cursoModuloTemaEvaluacions' => $cursoModuloTemaEvaluacions,
        ));
    }

    /**
     * Creates a new CursoModuloTemaEvaluacion entity.
     *
     * @Route("/new", name="admin_gestion_tema_evaluaciones_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoModuloTemaEvaluacion = new CursoModuloTemaEvaluacion();
        $form = $this->createForm('AppBundle\Form\CursoModuloTemaEvaluacionType', $cursoModuloTemaEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloTemaEvaluacion);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_tema_evaluaciones_show', array('id' => $cursoModuloTemaEvaluacion->getId()));
        }

        return $this->render('cursomodulotemaevaluacion/new.html.twig', array(
            'cursoModuloTemaEvaluacion' => $cursoModuloTemaEvaluacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoModuloTemaEvaluacion entity.
     *
     * @Route("/{id}", name="admin_gestion_tema_evaluaciones_show")
     * @Method("GET")
     */
    public function showAction(CursoModuloTemaEvaluacion $cursoModuloTemaEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloTemaEvaluacion);

        return $this->render('cursomodulotemaevaluacion/show.html.twig', array(
            'cursoModuloTemaEvaluacion' => $cursoModuloTemaEvaluacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoModuloTemaEvaluacion entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_tema_evaluaciones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoModuloTemaEvaluacion $cursoModuloTemaEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloTemaEvaluacion);
        $editForm = $this->createForm('AppBundle\Form\CursoModuloTemaEvaluacionType', $cursoModuloTemaEvaluacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloTemaEvaluacion);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_tema_evaluaciones_edit', array('id' => $cursoModuloTemaEvaluacion->getId()));
        }

        return $this->render('cursomodulotemaevaluacion/edit.html.twig', array(
            'cursoModuloTemaEvaluacion' => $cursoModuloTemaEvaluacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoModuloTemaEvaluacion entity.
     *
     * @Route("/{id}", name="admin_gestion_tema_evaluaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoModuloTemaEvaluacion $cursoModuloTemaEvaluacion)
    {
        $form = $this->createDeleteForm($cursoModuloTemaEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoModuloTemaEvaluacion);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_tema_evaluaciones_index');
    }

    /**
     * Creates a form to delete a CursoModuloTemaEvaluacion entity.
     *
     * @param CursoModuloTemaEvaluacion $cursoModuloTemaEvaluacion The CursoModuloTemaEvaluacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoModuloTemaEvaluacion $cursoModuloTemaEvaluacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_tema_evaluaciones_delete', array('id' => $cursoModuloTemaEvaluacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
