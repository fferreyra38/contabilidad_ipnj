<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Iglesia;
use AppBundle\Form\IglesiaType;

/**
 * Iglesia controller.
 *
 * @Route("/iglesia")
 */
class IglesiaController extends Controller
{
    /**
     * Lists all Iglesia entities.
     *
     * @Route("/", name="iglesia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $iglesias = $em->getRepository('AppBundle:Iglesia')->findAll();

        return $this->render('iglesia/index.html.twig', array(
            'iglesias' => $iglesias,
        ));
    }

    /**
     * Creates a new Iglesia entity.
     *
     * @Route("/new", name="iglesia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $iglesium = new Iglesia();
        $form = $this->createForm('AppBundle\Form\IglesiaType', $iglesium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($iglesium);
            $em->flush();

            return $this->redirectToRoute('iglesia_show', array('id' => $iglesium->getId()));
        }

        return $this->render('iglesia/new.html.twig', array(
            'iglesium' => $iglesium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Iglesia entity.
     *
     * @Route("/{id}", name="iglesia_show")
     * @Method("GET")
     */
    public function showAction(Iglesia $iglesium)
    {
        $deleteForm = $this->createDeleteForm($iglesium);

        return $this->render('iglesia/show.html.twig', array(
            'iglesium' => $iglesium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Iglesia entity.
     *
     * @Route("/{id}/edit", name="iglesia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Iglesia $iglesium)
    {
        $deleteForm = $this->createDeleteForm($iglesium);
        $editForm = $this->createForm('AppBundle\Form\IglesiaType', $iglesium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($iglesium);
            $em->flush();

            return $this->redirectToRoute('iglesia_edit', array('id' => $iglesium->getId()));
        }

        return $this->render('iglesia/edit.html.twig', array(
            'iglesium' => $iglesium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Iglesia entity.
     *
     * @Route("/{id}", name="iglesia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Iglesia $iglesium)
    {
        $form = $this->createDeleteForm($iglesium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($iglesium);
            $em->flush();
        }

        return $this->redirectToRoute('iglesia_index');
    }

    /**
     * Creates a form to delete a Iglesia entity.
     *
     * @param Iglesia $iglesium The Iglesia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Iglesia $iglesium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('iglesia_delete', array('id' => $iglesium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
