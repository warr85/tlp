<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoModuloUnidad;
use AppBundle\Form\CursoModuloUnidadType;

/**
 * CursoModuloUnidad controller.
 *
 * @Route("/admin/gestion/unidades")
 */
class CursoModuloUnidadController extends Controller
{
    /**
     * Lists all CursoModuloUnidad entities.
     *
     * @Route("/", name="admin_gestion_unidades_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoModuloUnidads = $em->getRepository('AppBundle:CursoModuloUnidad')->findAll();

        return $this->render('cursomodulounidad/index.html.twig', array(
            'cursoModuloUnidads' => $cursoModuloUnidads,
        ));
    }

    /**
     * Creates a new CursoModuloUnidad entity.
     *
     * @Route("/new", name="admin_gestion_unidades_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoModuloUnidad = new CursoModuloUnidad();
        $form = $this->createForm('AppBundle\Form\CursoModuloUnidadType', $cursoModuloUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloUnidad);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_unidades_show', array('id' => $cursoModuloUnidad->getId()));
        }

        return $this->render('cursomodulounidad/new.html.twig', array(
            'cursoModuloUnidad' => $cursoModuloUnidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoModuloUnidad entity.
     *
     * @Route("/{id}", name="admin_gestion_unidades_show")
     * @Method("GET")
     */
    public function showAction(CursoModuloUnidad $cursoModuloUnidad)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloUnidad);

        return $this->render('cursomodulounidad/show.html.twig', array(
            'cursoModuloUnidad' => $cursoModuloUnidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoModuloUnidad entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_unidades_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoModuloUnidad $cursoModuloUnidad)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloUnidad);
        $editForm = $this->createForm('AppBundle\Form\CursoModuloUnidadType', $cursoModuloUnidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloUnidad);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_unidades_edit', array('id' => $cursoModuloUnidad->getId()));
        }

        return $this->render('cursomodulounidad/edit.html.twig', array(
            'cursoModuloUnidad' => $cursoModuloUnidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoModuloUnidad entity.
     *
     * @Route("/{id}", name="admin_gestion_unidades_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoModuloUnidad $cursoModuloUnidad)
    {
        $form = $this->createDeleteForm($cursoModuloUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoModuloUnidad);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_unidades_index');
    }

    /**
     * Creates a form to delete a CursoModuloUnidad entity.
     *
     * @param CursoModuloUnidad $cursoModuloUnidad The CursoModuloUnidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoModuloUnidad $cursoModuloUnidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_unidades_delete', array('id' => $cursoModuloUnidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
