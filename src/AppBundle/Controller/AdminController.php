<?php

/*
 * Copyright (C) 2016 Tecnolínea Paraguná C.A.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Suscripcion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Redirecciona al dashboard de administrador del TLP
 *
 * @author Tecnolínea Paraguná C.A.
 * 
 * @Route("/admin")
 */
class AdminController extends Controller {
    
    /**
     * @Route("/", name="admin_homepage")
     */
    public function indexAction(Request $request){

        $em = $this->getDoctrine()->getManager();


        $notificaciones = $em->getRepository("AppBundle:Notificacion")->findBy(
            array("leida" => false)
        );
        $cuenta = count($notificaciones);
        return $this->render('admin/index.html.twig', array(
            'cuenta' => $cuenta,
            'notificaciones' => $notificaciones
        ));
        
    }


    /**
     * @Route("/suscripciones/{id}/show", name="suscripcion_admin_show")
     */
    public function suscripcionShowAction(Suscripcion $suscripcion){


        return $this->render('admin/index.html.twig', array(
            'cuenta' => $cuenta,
            'notificaciones' => $notificaciones
        ));

    }
    
    
}
