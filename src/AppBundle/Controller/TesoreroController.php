<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Tesorero;

/**
 * Tesorero controller.
 *
 * @Route("/tesorero")
 */
class TesoreroController extends Controller
{
    /**
     * Lists all Tesorero entities.
     *
     * @Route("/", name="tesorero_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tesoreros = $em->getRepository('AppBundle:Tesorero')->findAll();

        return $this->render('tesorero/index.html.twig', array(
            'tesoreros' => $tesoreros,
        ));
    }

    /**
     * Finds and displays a Tesorero entity.
     *
     * @Route("/{id}", name="tesorero_show")
     * @Method("GET")
     */
    public function showAction(Tesorero $tesorero)
    {

        return $this->render('tesorero/show.html.twig', array(
            'tesorero' => $tesorero,
        ));
    }
}
