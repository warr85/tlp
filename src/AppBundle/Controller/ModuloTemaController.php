<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ModuloTema;
use AppBundle\Form\ModuloTemaType;

/**
 * ModuloTema controller.
 *
 * @Route("/admin/gestion/temas")
 */
class ModuloTemaController extends Controller
{
    /**
     * Lists all ModuloTema entities.
     *
     * @Route("/", name="admin_gestion_temas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $moduloTemas = $em->getRepository('AppBundle:ModuloTema')->findAll();

        return $this->render('modulotema/index.html.twig', array(
            'moduloTemas' => $moduloTemas,
        ));
    }

    /**
     * Creates a new ModuloTema entity.
     *
     * @Route("/new", name="admin_gestion_temas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $moduloTema = new ModuloTema();
        $form = $this->createForm('AppBundle\Form\ModuloTemaType', $moduloTema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($moduloTema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_temas_show', array('id' => $moduloTema->getId()));
        }

        return $this->render('modulotema/new.html.twig', array(
            'moduloTema' => $moduloTema,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ModuloTema entity.
     *
     * @Route("/{id}", name="admin_gestion_temas_show")
     * @Method("GET")
     */
    public function showAction(ModuloTema $moduloTema)
    {
        $deleteForm = $this->createDeleteForm($moduloTema);

        return $this->render('modulotema/show.html.twig', array(
            'moduloTema' => $moduloTema,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ModuloTema entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_temas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ModuloTema $moduloTema)
    {
        $deleteForm = $this->createDeleteForm($moduloTema);
        $editForm = $this->createForm('AppBundle\Form\ModuloTemaType', $moduloTema);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($moduloTema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_temas_edit', array('id' => $moduloTema->getId()));
        }

        return $this->render('modulotema/edit.html.twig', array(
            'moduloTema' => $moduloTema,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ModuloTema entity.
     *
     * @Route("/{id}", name="admin_gestion_temas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ModuloTema $moduloTema)
    {
        $form = $this->createDeleteForm($moduloTema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($moduloTema);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_temas_index');
    }

    /**
     * Creates a form to delete a ModuloTema entity.
     *
     * @param ModuloTema $moduloTema The ModuloTema entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModuloTema $moduloTema)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_temas_delete', array('id' => $moduloTema->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
