<?php

namespace App\Services\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    const NUMBER_OF_OBJECTS = 10;

    public function loadUsers(ObjectManager $manager)
    {
        for ($i = 0; $i <= self::NUMBER_OF_OBJECTS; $i++) {
//            $user = new User()
        }
    }
}
