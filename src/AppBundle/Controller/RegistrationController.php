<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 09:08 AM
 */

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Adscripcion;
use AppBundle\Entity\DocenteEscala;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        
	    $adscripcion = new Adscripcion();
	    $escala = new DocenteEscala();

        /** @var TYPE_NAME $form */
        $form = $this->createForm('AppBundle\Form\UserType');
	    $form->handleRequest($request);

        $form->get('escala')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
        	  //var_dump($form->get('lineas_investigacion')->getData()); exit;

		 // $file stores the uploaded PDF file
            /** @var UploadedFile $constanciaTrabajo */
            $constanciaTrabajo = $form->get('trabajo')->getData();
            /** @var UploadedFile $constanciaPregrado */
            $constanciaPregrado = $form->get('pregrado')->getData();
            
            

            // Generate a unique name for the file before saving it
            $nombreTrabajo = md5(uniqid()).'.'.$constanciaTrabajo->guessExtension();
            $nombrePregrado = md5(uniqid()).'.'.$constanciaPregrado->guessExtension();

            // Move the file to the directory where brochures are stored
            $constanciaTrabajo->move(
                $this->container->getParameter('adscripcion_directory'),
                $nombreTrabajo
            );
            
             $constanciaPregrado->move(
                $this->container->getParameter('adscripcion_directory'),
                $nombrePregrado
            );
            
            if($form->get('postgrado')->getData()) {
                /** @var UploadedFile $constanciaPostgrado */
            	$constanciaPostgrado = $form->get('postgrado')->getData();
            	$nombrePostgrado = md5(uniqid()).'.'.$constanciaPostgrado->guessExtension();
            	$constanciaPostgrado->move(
                	$this->container->getParameter('adscripcion_directory'),
                	$nombrePostgrado
            	);
                $adscripcion->setPostgrado($nombrePostgrado);
            }
            $em = $this->getDoctrine()->getManager();

            $adscripcion->setTrabajo($nombreTrabajo);
            $adscripcion->setPregrado($nombrePregrado);            
            $adscripcion->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());


            if ($form->get('escala')->getData()){
                $escala->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                $escala->setFechaEscala($form->get('fecha_oposicion')->getData());
                $escala->setIdEscala($form->get('escala')->getData());
                $escala->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(1));
                $em->persist($escala);

                if($form->get('documento_oposicion')->getData()) {
                    $constanciaOposicion = $form->get('documento_oposicion')->getData();
                    $nombreOposicion = md5(uniqid()).'.'.$constanciaOposicion->guessExtension();
                    $constanciaOposicion->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreOposicion
                    );
                    $adscripcion->setOposicion($nombreOposicion);
                    $adscripcion->setIdLineaInvestigacion($form->get('lineas_investigacion')->getData());
                    $adscripcion->setTituloTrabajo($form->get('titulo_trabajo')->getData());
                }




                if ($form->get('documento_asistente')->getData()) {
                    $escala2 = new DocenteEscala();
                    $asistente = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(2);
                    $escala2->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala2->setFechaEscala($form->get('fecha_ascenso_asistente')->getData());
                    $escala2->setIdEscala($asistente);
                    $escala2->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala2);

                    $constanciaAsistente = $form->get('documento_asistente')->getData();
                    $nombreAsistente = md5(uniqid()).'.'.$constanciaAsistente->guessExtension();
                    $constanciaAsistente->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreAsistente
                    );
                    $adscripcion->setAsistente($nombreAsistente);


                }

               if ($form->get('documento_asociado')->getData()) {
                    $escala3 = new DocenteEscala();
                    $asociado = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(3);
                    $escala3->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala3->setFechaEscala($form->get('fecha_ascenso_asociado')->getData());
                    $escala3->setIdEscala($asociado);
                    $escala3->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala3);

                   $constanciaAsociado = $form->get('documento_asociado')->getData();
                   $nombreAsociado = md5(uniqid()).'.'.$constanciaAsociado->guessExtension();
                   $constanciaAsociado->move(
                       $this->container->getParameter('adscripcion_directory'),
                       $nombreAsociado
                   );
                   $adscripcion->setAsociado($nombreAsociado);
                }


                if ($form->get('documento_agregado')->getData()) {
                    $escala4 = new DocenteEscala();
                    $agregado = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(4);
                    $escala4->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala4->setFechaEscala($form->get('fecha_ascenso_agregado')->getData());
                    $escala4->setIdEscala($agregado);
                    $escala4->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala4);

                    $constanciaAgregado = $form->get('documento_agregado')->getData();
                    $nombreAgregado = md5(uniqid()).'.'.$constanciaAgregado->guessExtension();
                    $constanciaAgregado->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreAgregado
                    );
                    $adscripcion->setAgreado($nombreAgregado);
                }


                if ($form->get('documento_titular')->getData()) {
                    $escala5 = new DocenteEscala();
                    $titular = $this->getDoctrine()->getRepository('AppBundle:Escalafones')->findOneById(5);
                    $escala5->setIdRolInstitucion($this->getUser()->getIdRolInstitucion());
                    $escala5->setFechaEscala($form->get('fecha_ascenso_titular')->getData());
                    $escala5->setIdEscala($titular);
                    $escala5->setIdTipoEscala($this->getDoctrine()->getRepository('AppBundle:TipoAscenso')->findOneById(2));
                    $em->persist($escala5);

                    $constanciaTitular = $form->get('documento_titular')->getData();
                    $nombreTitular = md5(uniqid()).'.'.$constanciaTitular->guessExtension();
                    $constanciaTitular->move(
                        $this->container->getParameter('adscripcion_directory'),
                        $nombreTitular
                    );
                    $adscripcion->setTitular($nombreTitular);
                }

            }

            $em->persist($adscripcion);

            
            $em->flush(); //guarda en la base de datos
            

            

            //return $this->redirect($this->generateUrl('app_product_list'));	
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
