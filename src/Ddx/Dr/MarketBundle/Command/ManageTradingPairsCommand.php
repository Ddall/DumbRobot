<?php

/**
 * KrakenSetTradingPairsCommand.php - UTF-8
 * @author Allan IRDEL
 */

namespace Ddx\Dr\MarketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ManageTradingPairsCommand extends ContainerAwareCommand{
    public function configure() {
        $this
                ->setName('tradingpairs:manage')
                ->setDescription('Manages TradingPairs')
                ->addArgument('market', InputArgument::OPTIONAL, 'Markets name', null)
                ->addArgument('pair', InputArgument::OPTIONAL, 'TradingPairs name', null)
                ->addOption('enable')
                ->addOption('disable')
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        $krakenService  = $this->getContainer()->get('ddx.tradingpair');
        
        $pairs = $krakenService->manageTradingPair(  );

        $output->writeln('Available trading pairs:');
        foreach($pairs as $pair){
            $output->writeln(' - ' . $pair->getName());
        }
        

    }
}
