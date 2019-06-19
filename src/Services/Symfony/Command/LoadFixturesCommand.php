<?php

namespace App\Services\Symfony\Command;

use App\Services\DataFixtures\TaskFixture;
use App\Services\DataFixtures\UserFixture;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends Command
{
    /** @var UserFixture  */
    private $userFixture;

    /** @var TaskFixture */
    private $taskFixture;

    /** @var string  */
    protected static $defaultName = 'app:load-fixtures';

    public function __construct(
        UserFixture $userFixture,
        TaskFixture $taskFixture
    ) {
        parent::__construct();

        $this->userFixture = $userFixture;
        $this->taskFixture = $taskFixture;
    }

    protected function configure()
    {
        $this->setDescription('Command creates fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '============',
        ]);

        $output->writeln([
            'Generating users...',
        ]);

        $this->userFixture->loadUsers();

        $output->writeln([
            'Generating tasks...',
        ]);

        $this->taskFixture->loadTasks();

        $output->writeln([
            '============',
            'Finished generating fixtures',
            '============',
            '',
        ]);
    }
}
