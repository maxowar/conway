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
                'generations',
                InputArgument::OPTIONAL,
                'How many generations you want elapse in the Universe?'
            )
            ->addOption(
                'size',
                null,
                InputOption::VALUE_OPTIONAL,
                'Size of the universe',
                '25x10'
            )
            ->addOption(
                'load',
                'l',
                InputOption::VALUE_OPTIONAL,
                'Universe dump to load'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $game = new Game($input->getArgument('generations'));

        if($input->hasOption('load')) {
            if(!file_exists($input->getOption('load'))) {
                throw new \InvalidArgumentException('File not exists');
            }
            $game->loadUniverse($input->getOption('load'));
        }

        $game->run($input);
    }
}