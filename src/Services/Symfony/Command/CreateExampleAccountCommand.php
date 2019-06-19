<?php

namespace App\Services\Symfony\Command;

use App\Application\Command\ActivateAccountCommand;
use App\Application\CommandBusInterface;
use App\Domain\Exception\InvalidArgumentException;
use App\Services\DataFixtures\ActivationTokenFixture;
use App\Services\DataFixtures\UserFixture;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateExampleAccountCommand extends Command
{
    /** @var string  */
    protected static $defaultName = 'app:create-example-account';

    /** @var UserFixture  */
    private $userFixture;

    /** @var ActivationTokenFixture */
    private $activationTokenFixture;

    /** @var CommandBusInterface */
    private $commandBus;

    public function __construct(
        UserFixture $userFixture,
        ActivationTokenFixture $activationTokenFixture,
        CommandBusInterface $commandBus
    ) {
        parent::__construct();

        $this->userFixture = $userFixture;
        $this->activationTokenFixture = $activationTokenFixture;
        $this->commandBus = $commandBus;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $usernameQuestion = new Question('Please provide username: ');
        $passwordQuestion = new Question('Password: ');
        $passwordConfirmQuestion = new Question('Confirm Password: ');
        $roleQuestion = new Question('Please provide role: ');

        $username = $helper->ask($input, $output, $usernameQuestion);
        $password1 = $helper->ask($input, $output, $passwordQuestion);
        $password2 = $helper->ask($input, $output, $passwordConfirmQuestion);
        $role = $helper->ask($input, $output, $roleQuestion);

        $output->writeln([
            'Valid roles:',
            'ADMIN',
            'USER',
        ]);

        // Create Account
        $user = $this->userFixture->loadExampleUser((string)$username, (string)$role);
        $activationToken = $this->activationTokenFixture->loadActivationToken(['user' => $user]);

        // Activate Account
        try {
            $activateAccountCommand = new ActivateAccountCommand(
                $activationToken->getToken(),
                $password1,
                $password2
            );

            $this->commandBus->handle($activateAccountCommand);
        } catch (InvalidArgumentException $exception) {
            $output->writeln($exception->getMessage());
        }
        $output->writeln('User Created');
    }
}
