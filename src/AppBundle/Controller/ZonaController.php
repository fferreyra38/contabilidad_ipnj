<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Zona;
use AppBundle\Form\ZonaType;

/**
 * Zona controller.
 *
 * @Route("/zona")
 */
class ZonaController extends Controller
{
    /**
     * Lists all Zona entities.
     *
     * @Route("/", name="zona_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $zonas = $em->getRepository('AppBundle:Zona')->findAll();

        return $this->render('zona/index.html.twig', array(
            'zonas' => $zonas,
        ));
    }

    /**
     * Creates a new Zona entity.
     *
     * @Route("/new", name="zona_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $zona = new Zona();
        $form = $this->createForm('AppBundle\Form\ZonaType', $zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zona);
            $em->flush();

            return $this->redirectToRoute('zona_show', array('id' => $zona->getId()));
        }

        return $this->render('zona/new.html.twig', array(
            'zona' => $zona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Zona entity.
     *
     * @Route("/{id}", name="zona_show")
     * @Method("GET")
     */
    public function showAction(Zona $zona)
    {
        $deleteForm = $this->createDeleteForm($zona);

        return $this->render('zona/show.html.twig', array(
            'zona' => $zona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Zona entity.
     *
     * @Route("/{id}/edit", name="zona_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Zona $zona)
    {
        $deleteForm = $this->createDeleteForm($zona);
        $editForm = $this->createForm('AppBundle\Form\ZonaType', $zona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zona);
            $em->flush();

            return $this->redirectToRoute('zona_edit', array('id' => $zona->getId()));
        }

        return $this->render('zona/edit.html.twig', array(
            'zona' => $zona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Zona entity.
     *
     * @Route("/{id}", name="zona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Zona $zona)
    {
        $form = $this->createDeleteForm($zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($zona);
            $em->flush();
        }

        return $this->redirectToRoute('zona_index');
    }

    /**
     * Creates a form to delete a Zona entity.
     *
     * @param Zona $zona The Zona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Zona $zona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zona_delete', array('id' => $zona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
