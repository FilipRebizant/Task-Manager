<?php

namespace App\Services\DataFixtures;

use App\Domain\User\UserFactory;
use App\Domain\User\UserRepositoryInterface;
use Faker\Factory;
use Faker\Generator;
use Ramsey\Uuid\Uuid;

class UserFixture extends BaseFixture
{
    const NUMBER_OF_OBJECTS = 10;

    private $userRepository;

    private $userFactory;

    private $faker;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = new UserFactory();
        $this->faker = Factory::create();
    }

    public function loadUsers()
    {
        $faker = Factory::create();
        for ($i = 0; $i <= self::NUMBER_OF_OBJECTS; $i++) {

//            var_dump($faker);
            var_dump($this->faker->email);
            die;
//            var_dump($this);
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'username' => $this->faker->name,
                'email' => $this->faker->email,
                'role' => 'USER',
            ];
            $user = $this->userFactory->create($data);
            $this->userRepository->create($user);
        }
    }
}
