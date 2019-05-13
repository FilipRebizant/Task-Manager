<?php

namespace App\Domain\User;

use App\Application\AbstractService;
use App\Application\CommandInterface;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use Ramsey\Uuid\Uuid;

class UserService extends AbstractService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CommandInterface $command
     * @throws EmailAlreadyExistsException
     * @throws UserAlreadyExistsException
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function createUser(CommandInterface $command): void
    {
        if ($this->userAlreadyExists(new Username($command->username()))) {
            throw new UserAlreadyExistsException("Username already exists.");
        }

        if ($this->emailAlreadyExists(new Email($command->email()))) {
            throw new EmailAlreadyExistsException("Email address already exists.");
        }

        $user = new User(
            Uuid::uuid4(),
            new Username($command->username()),
            new Password($command->password()),
            new Email($command->email()),
            array()
        );

        $this->userRepository->create($user);
    }

    /**
     * @param Username $username
     * @return bool
     */
    private function userAlreadyExists(Username $username): bool
    {
        try {
            if ($this->userRepository->checkIfUsernameExists($username)) {
                return true;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        return false;
    }

    /**
     * @param Email $email
     * @return bool
     */
    private function emailAlreadyExists(Email $email): bool
    {
        try {
            if ($this->userRepository->checkIfEmailExists($email)) {
                return true;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        return false;
    }
}
