<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoModuloTema;
use AppBundle\Form\CursoModuloTemaType;

/**
 * CursoModuloTema controller.
 *
 * @Route("/admin/gestion/curso_modulo_temas")
 */
class CursoModuloTemaController extends Controller
{
    /**
     * Lists all CursoModuloTema entities.
     *
     * @Route("/", name="admin_gestion_curso_modulo_temas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoModuloTemas = $em->getRepository('AppBundle:CursoModuloTema')->findAll();

        return $this->render('cursomodulotema/index.html.twig', array(
            'cursoModuloTemas' => $cursoModuloTemas,
        ));
    }

    /**
     * Creates a new CursoModuloTema entity.
     *
     * @Route("/new", name="admin_gestion_curso_modulo_temas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoModuloTema = new CursoModuloTema();
        $form = $this->createForm('AppBundle\Form\CursoModuloTemaType', $cursoModuloTema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloTema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_curso_modulo_temas_show', array('id' => $cursoModuloTema->getId()));
        }

        return $this->render('cursomodulotema/new.html.twig', array(
            'cursoModuloTema' => $cursoModuloTema,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoModuloTema entity.
     *
     * @Route("/{id}", name="admin_gestion_curso_modulo_temas_show")
     * @Method("GET")
     */
    public function showAction(CursoModuloTema $cursoModuloTema)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloTema);

        return $this->render('cursomodulotema/show.html.twig', array(
            'cursoModuloTema' => $cursoModuloTema,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoModuloTema entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_curso_modulo_temas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoModuloTema $cursoModuloTema)
    {
        $deleteForm = $this->createDeleteForm($cursoModuloTema);
        $editForm = $this->createForm('AppBundle\Form\CursoModuloTemaType', $cursoModuloTema);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModuloTema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_curso_modulo_temas_edit', array('id' => $cursoModuloTema->getId()));
        }

        return $this->render('cursomodulotema/edit.html.twig', array(
            'cursoModuloTema' => $cursoModuloTema,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoModuloTema entity.
     *
     * @Route("/{id}", name="admin_gestion_curso_modulo_temas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoModuloTema $cursoModuloTema)
    {
        $form = $this->createDeleteForm($cursoModuloTema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoModuloTema);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_curso_modulo_temas_index');
    }

    /**
     * Creates a form to delete a CursoModuloTema entity.
     *
     * @param CursoModuloTema $cursoModuloTema The CursoModuloTema entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoModuloTema $cursoModuloTema)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_curso_modulo_temas_delete', array('id' => $cursoModuloTema->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
