<?php

/**
 * ShowTradesCommand.php - UTF-8
 * @author Allan IRDEL
 */

namespace Ddx\Dr\MarketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Exception as Exception;

class ShowTradesCommand extends ContainerAwareCommand{
    public function configure() {
        $this
                ->setName('trades:show')
                ->setDescription('Use this to show trades')
                ->addArgument('market', InputArgument::OPTIONAL, 'Markets name', null)
                ->addArgument('pair', InputArgument::OPTIONAL, 'TradingPairs name', null)
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        $krakenService  = $this->getContainer()->get('ddx.trade');
        
        $market = $this->getContainer()->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:Market')->findOneByName('Kraken');
        if(!$market){
            throw new Exception('MARKET NOT FOUND');
        }
        
        $pairs = $market->getActiveTradingPairs();
        
        $data = array();
        foreach($pairs as $pair){
            $data[$pair->getRemoteName()] = $krakenService->getTrades($market, $pair);
        }
        
        $output->writeln('Trades for ' . $market->getName() );
        foreach($data as $name => $values){
            $output->writeln( $name . ': ' . count($values) . ' records');
        }

    }
}
