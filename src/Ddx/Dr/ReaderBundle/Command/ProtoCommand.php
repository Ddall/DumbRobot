<?php

/**
 * ProtoCommand.php - UTF-8
 * @author Allan IRDEL
 */

namespace Ddx\Dr\ReaderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Payward\KrakenAPI;
use Ddx\Dr\ReaderBundle\Market\KrakenApiWrapper;

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
        $kraken = new KrakenApiWrapper($this->getContainer());
//        $data = $kraken->getTradeHistory();
//        
        $krakenService  = $this->getContainer()->get('ddx.kraken');
//        $krakenService->updateTradingPairs();
        
        $data = $krakenService->readMarket();
        
        $output->writeln(print_r($data, true));
        
    }
}
