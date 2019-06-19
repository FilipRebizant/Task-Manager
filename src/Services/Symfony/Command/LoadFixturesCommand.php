<?php

namespace App\Services\Symfony\Command;

use App\Services\DataFixtures\ActivationTokenFixture;
use App\Services\DataFixtures\TaskFixture;
use App\Services\DataFixtures\UserFixture;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends Command
{
    const NUMBER_OF_OBJECTS = 10;

    /** @var UserFixture  */
    private $userFixture;

    /** @var TaskFixture */
    private $taskFixture;

    /** @var ActivationTokenFixture */
    private $activationTokenFixture;

    /** @var string  */
    protected static $defaultName = 'app:load-fixtures';

    public function __construct(
        UserFixture $userFixture,
        TaskFixture $taskFixture,
        ActivationTokenFixture $activationTokenFixture
    ) {
        parent::__construct();

        $this->userFixture = $userFixture;
        $this->taskFixture = $taskFixture;
        $this->activationTokenFixture = $activationTokenFixture;
    }

    protected function configure()
    {
        $this->setDescription('Command creates fixtures');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '============',
            'Generating fixtures',
            '============',
            '',
        ]);

        for ($i = 0; $i <= self::NUMBER_OF_OBJECTS; $i++) {

            $user = $this->userFixture->loadUser();

            $task = $this->taskFixture->loadTask(['user' => $user]);
            $taskWithoutUser = $this->taskFixture->loadTaskWithoutUser();
            $activationToken = $this->activationTokenFixture->loadActivationToken(['user' => $user]);
        }

        $output->writeln([
            '============',
            'Finished generating fixtures',
            '============',

        ]);
    }
}
