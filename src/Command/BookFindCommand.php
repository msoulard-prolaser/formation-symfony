<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:book:find',
    description: 'Add a short description for your command',
)]
class BookFindCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('lastname', InputArgument::REQUIRED, 'Argument description')
            ->addArgument('firstname', InputArgument::OPTIONAL|InputArgument::IS_ARRAY, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_REQUIRED, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $firstname = $input->getArgument('firstname');
        $lastname = $input->getArgument('lastname');

        if ($lastname) {
            $io->note(sprintf('You passed an lastname: %s', $lastname));
        }
        if ($firstname) {
            $io->note(sprintf('You passed an firstname(s): %s', implode(', ', $firstname)));
        }

        if ($input->getOption('option1')) {
            $io->note('You passe an option :'.$input->getOption('option1'));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
