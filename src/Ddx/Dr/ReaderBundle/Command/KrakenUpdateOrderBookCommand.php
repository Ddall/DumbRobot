<?php

/**
 * KrakenUpdateOrderBookCommand.php - UTF-8
 * @author Allan IRDEL 
 */
namespace Ddx\Dr\ReaderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class KrakenUpdateOrderBookCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('kraken:orderbook:update')
                ->setDescription('Kraken: Use this to update the orderbook of Kraken' .PHP_EOL .'Costs 1 points per active tradingpair')
                ->addArgument('pair', InputArgument::OPTIONAL, 'Select only one trading pair', null)
                ->addOption('dryrun', null, InputOption::VALUE_NONE, 'DONT KEEP CHANGES ')
        ;
    }
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        if($input->getOption('dryrun') && $input->getOption('dryrun') == true){
            $output->writeln('DRYRUN: DATA WONT BE FLUSHED');
        }
        
        $output->write('Updating Krakens orderbook for all active trading pairs ... ');
        $krakenService  = $this->getContainer()->get('ddx.kraken');
        
        $count = $krakenService->updateAllOrderBook( $input->getOption('dryrun') );
        $output->writeln(' DONE.');
        
//        $output->writeln('Summary of new elements:');
//        foreach($count as $key => $line){
//            $output->writeln('- '. $key . ': ' .$line . ' new Trades');
//        }
        
    }
}
