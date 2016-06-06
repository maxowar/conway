<?php

namespace Maxowar\Conway\Console;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Maxowar\Conway\Game;

class ConwayCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('Conway')
            ->setDescription('PHP Cornways life game')
            ->addArgument(
                'iterations',
                InputArgument::OPTIONAL,
                'How many life cycles?'
            )
            ->addOption(
                'size',
                null,
                InputOption::VALUE_OPTIONAL,
                'Size of the universe',
                '25x10'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $game = new Game();
        $game->run();
    }
}