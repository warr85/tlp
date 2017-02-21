<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CursoModulo;
use AppBundle\Form\CursoModuloType;

/**
 * CursoModulo controller.
 *
 * @Route("/admin/gestion/curso_modulos")
 */
class CursoModuloController extends Controller
{
    /**
     * Lists all CursoModulo entities.
     *
     * @Route("/", name="admin_gestion_curso_modulos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cursoModulos = $em->getRepository('AppBundle:CursoModulo')->findAll();

        return $this->render('cursomodulo/index.html.twig', array(
            'cursoModulos' => $cursoModulos,
        ));
    }

    /**
     * Creates a new CursoModulo entity.
     *
     * @Route("/new", name="admin_gestion_curso_modulos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cursoModulo = new CursoModulo();
        $form = $this->createForm('AppBundle\Form\CursoModuloType', $cursoModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curso = $this->getDoctrine()->getRepository('AppBundle:Curso')->findOneById($cursoModulo->getIdCurso());
            $curso->addModulo($cursoModulo);
            $em->persist($cursoModulo);
            $em->persist($curso);
            $em->flush();
            
            

            return $this->redirectToRoute('admin_gestion_curso_modulos_show', array('id' => $cursoModulo->getId()));
        }

        return $this->render('cursomodulo/new.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CursoModulo entity.
     *
     * @Route("/{id}", name="admin_gestion_curso_modulos_show")
     * @Method("GET")
     */
    public function showAction(CursoModulo $cursoModulo)
    {
        $deleteForm = $this->createDeleteForm($cursoModulo);

        return $this->render('cursomodulo/show.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoModulo entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_curso_modulos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CursoModulo $cursoModulo)
    {
        $deleteForm = $this->createDeleteForm($cursoModulo);
        $editForm = $this->createForm('AppBundle\Form\CursoModuloType', $cursoModulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursoModulo);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_curso_modulos_edit', array('id' => $cursoModulo->getId()));
        }

        return $this->render('cursomodulo/edit.html.twig', array(
            'cursoModulo' => $cursoModulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoModulo entity.
     *
     * @Route("/{id}", name="admin_gestion_curso_modulos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CursoModulo $cursoModulo)
    {
        $form = $this->createDeleteForm($cursoModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cursoModulo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_curso_modulos_index');
    }

    /**
     * Creates a form to delete a CursoModulo entity.
     *
     * @param CursoModulo $cursoModulo The CursoModulo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CursoModulo $cursoModulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_curso_modulos_delete', array('id' => $cursoModulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
