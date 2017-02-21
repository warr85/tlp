<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoGrupo;
use AppBundle\Form\CursoGrupoType;

/**
 * CursoGrupo controller.
 *
 * @Route("/admin/gestion/grupos")
 */
class CursoGrupoController extends Controller
{
    /**
     * Lists all CursoGrupo entities.
     *
     * @Route("/", name="admin_gestion_grupos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoGrupos = $em->getRepository('AppBundle:CursoGrupo')->findAll();

        return $this->render('cursogrupo/index.html.twig', array(
            'cursoGrupos' => $cursoGrupos,
        ));
    }

    /**
     * Creates a new CursoGrupo entity.
     *
     * @Route("/new", name="admin_gestion_grupos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoGrupo = new CursoGrupo();
        $form = $this->createForm('AppBundle\Form\CursoGrupoType', $cursoGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoGrupo);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_grupos_show', array('id' => $cursoGrupo->getId()));
        }

        return $this->render('cursogrupo/new.html.twig', array(
            'cursoGrupo' => $cursoGrupo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoGrupo entity.
     *
     * @Route("/{id}", name="admin_gestion_grupos_show")
     * @Method("GET")
     */
    public function showAction(CursoGrupo $cursoGrupo)
    {
        $deleteForm = $this->createDeleteForm($cursoGrupo);

        return $this->render('cursogrupo/show.html.twig', array(
            'cursoGrupo' => $cursoGrupo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoGrupo entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_grupos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoGrupo $cursoGrupo)
    {
        $deleteForm = $this->createDeleteForm($cursoGrupo);
        $editForm = $this->createForm('AppBundle\Form\CursoGrupoType', $cursoGrupo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoGrupo);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_grupos_edit', array('id' => $cursoGrupo->getId()));
        }

        return $this->render('cursogrupo/edit.html.twig', array(
            'cursoGrupo' => $cursoGrupo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoGrupo entity.
     *
     * @Route("/{id}", name="admin_gestion_grupos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoGrupo $cursoGrupo)
    {
        $form = $this->createDeleteForm($cursoGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoGrupo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_grupos_index');
    }

    /**
     * Creates a form to delete a CursoGrupo entity.
     *
     * @param CursoGrupo $cursoGrupo The CursoGrupo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoGrupo $cursoGrupo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_grupos_delete', array('id' => $cursoGrupo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
