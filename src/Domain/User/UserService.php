<?php

namespace App\Domain\User;

use App\Application\Command\CreatePasswordCommand;
use App\Application\Command\CreateUserCommand;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Security\Symfony\SessionAuth\SessionAuthUser;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var EncoderFactoryInterface */
    private $passwordEncoder;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param EncoderFactoryInterface $passwordEncoder
     */
    public function __construct(UserRepositoryInterface $userRepository, EncoderFactoryInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param CreateUserCommand $command
     * @throws EmailAlreadyExistsException
     * @throws InvalidArgumentException
     * @throws UserAlreadyExistsException
     */
    public function createUser(CreateUserCommand $command): void
    {
        if ($this->userAlreadyExists(new Username($command->username()))) {
            throw new UserAlreadyExistsException("Username already exists");
        }

        if ($this->emailAlreadyExists(new Email($command->email()))) {
            throw new EmailAlreadyExistsException("Email address already exists");
        }

        $user = new User(
            Uuid::uuid4(),
            new Username($command->username()),
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

    public function createPassword(CreatePasswordCommand $command): void
    {
        if ($command->password1() !== $command->password2()) {
            throw new InvalidArgumentException("Provided passwords doesn't match");
        }

        $password = new Password($command->password1()); // Create Password instance to validate

        $encoder = $this->passwordEncoder->getEncoder(SessionAuthUser::class);
        $encodedPassword = $encoder->encodePassword($password, getenv('APP_SALT'));

//        $this->userRepository->
    }
}
