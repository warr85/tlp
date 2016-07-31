<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Tema;
use AppBundle\Form\TemaType;

/**
 * Tema controller.
 *
 * @Route("/admin/gestion/temas")
 */
class TemaController extends Controller
{
    /**
     * Lists all Tema entities.
     *
     * @Route("/", name="admin_gestion_temas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $temas = $em->getRepository('AppBundle:Tema')->findAll();

        return $this->render('tema/index.html.twig', array(
            'temas' => $temas,
        ));
    }

    /**
     * Creates a new Tema entity.
     *
     * @Route("/new", name="admin_gestion_temas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tema = new Tema();
        $form = $this->createForm('AppBundle\Form\TemaType', $tema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_temas_show', array('id' => $tema->getId()));
        }

        return $this->render('tema/new.html.twig', array(
            'tema' => $tema,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tema entity.
     *
     * @Route("/{id}", name="admin_gestion_temas_show")
     * @Method("GET")
     */
    public function showAction(Tema $tema)
    {
        $deleteForm = $this->createDeleteForm($tema);

        return $this->render('tema/show.html.twig', array(
            'tema' => $tema,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tema entity.
     *
     * @Route("/{id}/edit", name="admin_gestion_temas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tema $tema)
    {
        $deleteForm = $this->createDeleteForm($tema);
        $editForm = $this->createForm('AppBundle\Form\TemaType', $tema);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tema);
            $em->flush();

            return $this->redirectToRoute('admin_gestion_temas_edit', array('id' => $tema->getId()));
        }

        return $this->render('tema/edit.html.twig', array(
            'tema' => $tema,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tema entity.
     *
     * @Route("/{id}", name="admin_gestion_temas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tema $tema)
    {
        $form = $this->createDeleteForm($tema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tema);
            $em->flush();
        }

        return $this->redirectToRoute('admin_gestion_temas_index');
    }

    /**
     * Creates a form to delete a Tema entity.
     *
     * @param Tema $tema The Tema entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tema $tema)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gestion_temas_delete', array('id' => $tema->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
