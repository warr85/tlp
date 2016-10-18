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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ElearningController
 * Este controlador es el que gestiona el aprendizaje del estudiante
 * a lo largo de su vida con el curso que haya suscrito en la pagina del portal
 *
 * @author Tecnolínea Paraguná C.A.
 * 
 * @Route("/estudiante")
 */
class ElearningController extends Controller {
    
    /**
     * @Route("/", name="estudiante_homepage")
     */
    public function indexAction(Request $request){
        
        return $this->render('estudiante/index.html.twig');
        
    }
    
    
}
