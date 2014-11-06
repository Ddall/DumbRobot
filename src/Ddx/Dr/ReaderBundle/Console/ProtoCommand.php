<?php

/**
 * Description of ProtoCommand
 * ProtoCommand.php - UTF-8
 * @author Allan IRDEL <a.irdel@plan-immobilier.fr>
 */

namespace Back\CommonBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProtoCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('proto:run')
                ->setDescription('TEST COMMAND')
                ->addOption('dryrun', null, InputOption::VALUE_NONE, 'DONT KEEP CHANGES || DONT SEND ANYTHING')
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        $kraken = new \Payward\KrakenAPI($key, $secret);

        
    }
}
