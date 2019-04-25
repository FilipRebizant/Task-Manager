<?php

namespace App\Domain\User;

use App\Application\CommandInterface;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use Ramsey\Uuid\Uuid;

class UserService
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
     * @throws Exception\InvalidEmailException
     * @throws Exception\InvalidPasswordException
     * @throws Exception\InvalidUsernameException
     * @throws UserAlreadyExistsException
     */
    public function createUser(CommandInterface $command): void
    {
        if ($this->userAlreadyExists(new Username($command->username()))) {
            throw new UserAlreadyExistsException();
        }

        if ($this->emailAlreadyExists(new Email($command->email()))) {
            throw new EmailAlreadyExistsException();
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
            if ($this->userRepository->getUserByUsername($username)) {
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
            if ($this->userRepository->getUserByEmail($email)) {
                return true;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        return false;
    }
}
