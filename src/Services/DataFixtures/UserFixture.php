<?php

namespace App\Services\DataFixtures;

use App\Domain\User\UserFactory;
use App\Domain\User\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;

class UserFixture extends BaseFixture
{
    /** @var UserRepositoryInterface  */
    private $userRepository;

    /** @var UserFactory  */
    private $userFactory;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->userFactory = new UserFactory();
    }

    public function loadUsers()
    {
        for ($i = 0; $i <= self::NUMBER_OF_OBJECTS; $i++) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'username' => $this->faker->userName,
                'email' => $this->faker->email,
                'role' => 'USER',
            ];
            $user = $this->userFactory->create($data);
            $this->userRepository->create($user);
        }
    }
}
