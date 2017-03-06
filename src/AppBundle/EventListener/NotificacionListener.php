<?php
/**
 * Created by PhpStorm.
 * User: Wilmer Ramones
 * Date: 23/02/17
 * Time: 01:53 PM
 */

namespace AppBundle\EventListener;
use AppBundle\Entity\Notificacion;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Entity\Suscripcion;


class NotificacionListener
{
    public function postUpdate(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $em = $args->getObjectManager();


        if ($entity instanceof Suscripcion) {
            $notificar = new Notificacion();
            $notificar->setIdEstatus($entity->getIdEstatus());
            $notificar->setIdTipoNotificacion($em->getRepository("AppBundle:TipoNotificacion")->findOneById(1));
            $notificar->setLeida(false);
            $notificar->setIdNotificacion($entity->getId());
            $em->persist($notificar);
            $em->flush();
        }






    }

}