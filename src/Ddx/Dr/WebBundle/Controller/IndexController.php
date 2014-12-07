<?php
namespace Ddx\Dr\WebBundle\Controller;
/**
 * IndexController.php UTF-8
 * @author Allan IRDEL
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Ob\HighchartsBundle\Highcharts\Highstock;
use Ob\HighchartsBundle\Highcharts\Highchart;

class IndexController extends Controller{

    /**
     * route /kraken/history
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function krakenHistoryAction(){
        $kraken = $this->getHelper()->getMarketRepository()->findOneBy(array('name' => 'Kraken'));
        $tradingRepo = $this->getHelper()->getTradeRepository();
        
        $allTrades = $kraken->getTrades();
        $vwap = $tradingRepo->getWeightedData($kraken, $kraken->getActiveTradingPairs()->first(), 300);
        
        $tmp = array();
        foreach($allTrades as $trade){
            $tmp[] = array(
                'x' => $trade->getTimeRemote(),
                'y' => $trade->getVolume(),
            );
        }
        

        return $this->render('DdxDrWebBundle:History:index.html.twig', array(
            'allTrades' => $allTrades,
            'vwapData' => $vwap,
            'graphData' => $tmp,
        ));
    }

    /**
     * route /kraken/ohlc
     * https://github.com/marcaube/ObHighchartsBundle/blob/master/Resources/doc/usage.md
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function krakenOHLCAction(){
        $kraken = $this->getHelper()->getMarketRepository()->find(1);
        $data = $this->getHelper()->getTradeRepository()->getOHLCData($kraken, $kraken->getActiveTradingPairs()->first(), 600 );
        die('<pre>'.print_r($data, true));
        $out = array();
        foreach($data as $i){
            $out[] = $i['vwap'];
        }
        
        $series = array(
            'name'  => 'OHLC',
            'data'  => $out,
        );
        
        $ch = new Highchart();
        $ch->chart->renderTo('linechart');
        $ch->title->text('Kraken all time OHLC DATA');
        $ch->series($series);

        return $this->render('DdxDrWebBundle:History:ohlc.html.twig', array(
            'data' => $data,
            'chart' => $ch
        ));
    }
    
    /**
     * @return \Ddx\Dr\ReaderBundle\Service\BaseHelper
     */
    protected function getHelper(){
        return $this->get('ddx.helper');
    }
}
