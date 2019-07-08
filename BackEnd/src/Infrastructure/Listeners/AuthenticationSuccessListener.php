<?php

namespace App\Infrastructure\Listeners;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();
        $data = $event->getData();

        $data['data'] = array(
            'user' => $user->getUsername(),
            'roles' => $user->getRoles(),
        );

        $event->setData($data);
    }
}
