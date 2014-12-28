<?php

/**
 * ProtoCommand.php - UTF-8
 * @author Allan IRDEL
 */

namespace Ddx\Dr\ReaderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProtoCommand extends ContainerAwareCommand {

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
        /**
         * @var \Ddx\Dr\ReaderBundle\Service\BaseHelper
         */
        $base = $this->getContainer()->get('ddx.helper');
        $kraken = $base->getMarketRepository()->find(1); // @WARN NEED TO GENERALIZE THIS
        
        $data = $base->getTradeService()->computeTrades($kraken, $kraken->getActiveTradingPairs()->first());
        
        
        $output->writeln(print_r($data, true));
        
        
        
    }
}
