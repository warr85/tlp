<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoModulos;
use AppBundle\Form\CursoModulosType;

/**
 * CursoModulos controller.
 *
 * @Route("/admin/gestion/modulos")
 */
class CursoModulosController extends Controller
{
    /**
     * Lists all CursoModulos entities.
     *
     * @Route("/", name="admin_gestion_cursos_modulos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoModulos = $em->getRepository('AppBundle:CursoModulos')->findAll();

        return $this->render('cursomodulos/index.html.twig', array(
            'cursoModulos' => $cursoModulos,
        ));
    }

    /**
     * Creates a new CursoModulos entity.
     *
     * @Route("/new", name="admin_gestion_cursos_modulos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoModulo = new CursoModulos();
        $form = $this->createForm('AppBundle\Form\CursoModulosType', $cursoModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModulo);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_cursos_modulos_show', array('id' => $cursoModulo->getId()));
        }

        return $this->render('cursomodulos/new.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoModulos entity.
     *
     * @Route("/{id}", name="admin_gestion_cursos_modulos_show")
     * @Method("GET")
     */
    public function showAction(CursoModulos $cursoModulo)
    {
        $deleteForm = $this->createDeleteForm($cursoModulo);

        return $this->render('cursomodulos/show.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoModulos entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_cursos_modulos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoModulos $cursoModulo)
    {
        $deleteForm = $this->createDeleteForm($cursoModulo);
        $editForm = $this->createForm('AppBundle\Form\CursoModulosType', $cursoModulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModulo);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_cursos_modulos_edit', array('id' => $cursoModulo->getId()));
        }

        return $this->render('cursomodulos/edit.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoModulos entity.
     *
     * @Route("/{id}", name="admin_gestion_cursos_modulos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoModulos $cursoModulo)
    {
        $form = $this->createDeleteForm($cursoModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoModulo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_cursos_modulos_index');
    }

    /**
     * Creates a form to delete a CursoModulos entity.
     *
     * @param CursoModulos $cursoModulo The CursoModulos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoModulos $cursoModulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_cursos_modulos_delete', array('id' => $cursoModulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
