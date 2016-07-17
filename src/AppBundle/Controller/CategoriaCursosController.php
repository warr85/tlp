<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CategoriaCursos;
use AppBundle\Form\CategoriaCursosType;

/**
 * CategoriaCursos controller.
 *
 * @Route("/admin/gestion/categorias")
 */
class CategoriaCursosController extends Controller
{
    /**
     * Lists all CategoriaCursos entities.
     *
     * @Route("/", name="admin_gestion_categorias_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriaCursos = $em->getRepository('AppBundle:CategoriaCursos')->findAll();

        return $this->render('categoriacursos/index.html.twig', array(
            'categoriaCursos' => $categoriaCursos,
        ));
    }

    /**
     * Creates a new CategoriaCursos entity.
     *
     * @Route("/new", name="admin_gestion_categorias_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categoriaCurso = new CategoriaCursos();
        $form = $this->createForm('AppBundle\Form\CategoriaCursosType', $categoriaCurso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriaCurso);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_categorias_show', array('id' => $categoriaCurso->getId()));
        }

        return $this->render('categoriacursos/new.html.twig', array(
            'categoriaCurso' => $categoriaCurso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CategoriaCursos entity.
     *
     * @Route("/{id}", name="admin_gestion_categorias_show")
     * @Method("GET")
     */
    public function showAction(CategoriaCursos $categoriaCurso)
    {
        $deleteForm = $this->createDeleteForm($categoriaCurso);

        return $this->render('categoriacursos/show.html.twig', array(
            'categoriaCurso' => $categoriaCurso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CategoriaCursos entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_categorias_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategoriaCursos $categoriaCurso)
    {
        $deleteForm = $this->createDeleteForm($categoriaCurso);
        $editForm = $this->createForm('AppBundle\Form\CategoriaCursosType', $categoriaCurso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriaCurso);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_categorias_edit', array('id' => $categoriaCurso->getId()));
        }

        return $this->render('categoriacursos/edit.html.twig', array(
            'categoriaCurso' => $categoriaCurso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CategoriaCursos entity.
     *
     * @Route("/{id}", name="admin_gestion_categorias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategoriaCursos $categoriaCurso)
    {
        $form = $this->createDeleteForm($categoriaCurso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoriaCurso);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_categorias_index');
    }

    /**
     * Creates a form to delete a CategoriaCursos entity.
     *
     * @param CategoriaCursos $categoriaCurso The CategoriaCursos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoriaCursos $categoriaCurso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_categorias_delete', array('id' => $categoriaCurso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
