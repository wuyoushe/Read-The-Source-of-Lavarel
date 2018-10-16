<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestToto extends Command
{
    protected function configure()
    {
        $this
            ->setName('testController-toto')
            ->setDescription('The testController-toto command')
            ->setAliases(array('testController'))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('testController-toto');
    }
}
