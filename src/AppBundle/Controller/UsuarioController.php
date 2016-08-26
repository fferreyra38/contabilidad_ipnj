<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Routing\ClassResourceInterface;


/**
 * Usuario controller.
 *
 */
class UsuarioController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Usuario entities.
     * @View()
     */
    public function cgetAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:Envio')
            ->findAll();
        
        return ['users' => $users];       
    }
    
    // "get_usuario"      [GET] /usuario/{id}
    public function getAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:Usuario')
            ->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException();
        }
        
        return ['user' => $user];
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     
    public function showAction(Usuario $usuario)
    {

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
        ));
    }*/
}
