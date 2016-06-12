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
                'width',
                InputArgument::OPTIONAL,
                'Width of the Universe'
            )
            ->addArgument(
                'height',
                InputArgument::OPTIONAL,
                'Height of the Universe'
            )
            ->addOption(
                'generations',
                'g',
                InputOption::VALUE_OPTIONAL,
                'How many generations you want elapse in the Universe?',
                1
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
        $game = new Game([
            'width' => $input->getArgument('width'),
            'height' => $input->getArgument('height'),
            'load' => $input->getOption('load'),
        ]);

        $game->init();
        $game->run($input->getOption('generations'));
    }
}