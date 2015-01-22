<?php
namespace Ddx\Dr\StrategyBundle\Command;

/**
 * CruncherCommand
 * @author Allan
 */

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CruncherCommand  extends ContainerAwareCommand{
    public function configure() {
        $this
                ->setName('cruncher:run')
                ->setDescription('Run a specific cruncher on a set market and tradingpair')
                ->addArgument('cruncher', InputArgument::REQUIRED, 'Crunchers name', null)
                ->addArgument('market', InputArgument::REQUIRED, 'Markets name', null)
                ->addArgument('pair', InputArgument::REQUIRED, 'TradingPairs name', null)
        ;        
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        $this->getBaseHelper();
        
    }
    
    /**
     * @return \Ddx\Dr\ReaderBundle\Service\BaseHelper
     */
    public function getBaseHelper(){
        return $this->get('ddx.helper');
    }
}
