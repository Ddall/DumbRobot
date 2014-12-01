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
        
        $krakenService  = $this->getContainer()->get('ddx.dummy');
        die(get_class($krakenService->getEm()->getRepository('DdxDrMarketBundle:Market')->find(1)));
        $output->writeln(print_r($data, true));
        
    }
}
