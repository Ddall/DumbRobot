<?php
/**
 * KrakenLoadHistoricalDataCommand.php - UTF-8
 * @author Allan
 */
namespace Ddx\Dr\ReaderBundle\Command;
    

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ddx\Dr\MarketBundle\Entity\Trade;

class KrakenLoadHistoricalDataCommand extends ContainerAwareCommand{
    
    
    protected function configure() {
        $this
                ->setName('kraken:historicaldata:load')
                ->setDescription('Kraken: Use this to load the historical trading data from')
                ->addOption('dryrun', null, InputOption::VALUE_NONE, 'DONT KEEP CHANGES ')
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Updating Kraken all time historical data');
        
        $output->write('Downloading ...');
        
        if(file_exists('historical.csv') === false){
            
            $url = 'http://api.bitcoincharts.com/v1/csv/krakenEUR.csv.gz';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);
            curl_close($curl);
            $output->writeln(' DONE.');

            $output->write('Decompressing gz file ...');
            $file = gzinflate($data, 280000000);
            file_put_contents('historical.csv', $file);
            $output->writeln(' DONE');
            
        }else{
            $output->writeln(' File exists, skipping');
        }

        $output->write('Loading data ...');
        $file = fopen('historical.csv', 'r');
        
        
        $em = $this->getContainer()->get('doctrine')->getManager();
        $market = $this->getContainer()->get('ddx.helper')->getMarketRepository()->findOneByName('Kraken');
        $tradingPair = $this->getContainer()->get('ddx.helper')->getTradingPairRepository()->findOneBy(array(
            'market' => $market->getId(),
            'name' => 'XXBTZEUR',
        ));
        
        $i = 0;
        while( ($line =fgetcsv($file)) !== FALSE ){
            
            $e = new Trade();
            $e
                    ->setMarket($market)
                    ->setTradingPair($tradingPair)
                    ->setTimeRemoteFromTimestamp($line[0])
                    ->setPrice($line[1])
                    ->setVolume($line[2])
                    ;
                    
            $em->persist($e);
            $i++;
            
        }
        $output->write(' DB: ');
        $em->flush();
        $output->write('Flushed ' . $i . ' to the database');
//        
    }
}
