<?php

namespace Org\Decatime\Event;

use Doctrine\ORM\Event\LifeCycleEventArgs;
use Org\Decatime\Entity\Rankable;

final class EntityListener
{

    public function postRemove(LifeCycleEventArgs $args)
    {
        $entity = $args->getObject();
        $ema = $args->getObjectManager();
        $uow = $ema->getUnitOfWork();
        if ($entity instanceof Rankable) {
            // todo: problem here is cascade deletion...
            // if I delete a Chapter that has Content then
            // content will also be deleted and I don't need to update
            // it's position.
        }
    }
}
