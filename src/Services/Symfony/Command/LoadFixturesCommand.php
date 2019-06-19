<?php

namespace App\Services\Symfony\Command;

use App\Domain\User\UserRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends Command
{
    private $userRepository;

    protected static $defaultName = 'app:load-fixtures';

    protected function configure()
    {
        $this->setDescription('Command creates fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Generating users...',
            '============',
            '',
        ]);

        var_dump($this->userRepository);

        $output->writeln([
            'Users had been generated',
            '============',
            '',
        ]);
    }

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }
}
