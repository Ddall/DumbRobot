<?php
namespace Ddx\Dr\WebBundle\Controller;
/**
 * IndexController.php UTF-8
 * @author Allan IRDEL
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highstock;

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
     * http://api.highcharts.com/highstock#series.data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function krakenOHLCAction(){
        $kraken = $this->getHelper()->getMarketRepository()->find(1);
        $data = $this->getHelper()->getTradeRepository()->getOHLCData($kraken, $kraken->getActiveTradingPairs()->first(), 300 );
        
        $ohlc = array();
        $volume = array();
        foreach($data as $line){
            $ohlc[] = array(
                (integer) $line['period_unix']*1000,
                (integer) $line['open'],
                (integer) $line['high'],
                (integer) $line['low'],
                (integer) $line['close'],
            );
            
            $volume[] = (integer)$line['volume'];
        }
        
        $series = array(
            array(
                'name' => 'OHLC',
                'type' => 'candlestick',
                'dataGrouping' => array(
                    'units' => array(
                        array('week', array(1)),
                        array('month', array(1,3,6)),
                        array('year', array(1))
                    )
                ),
                'data' => $ohlc,
            ),
            
        );
        
        
        $ob = new Highstock();
        $ob->chart->renderTo('linechart');
        $ob->chart->title('Kraken historical data');
        $ob->xAxis->title('Time');
        $ob->yAxis->title('Price');
        $ob->series($series);
        $ob->rangeSelector->selected('2');

        return $this->render('DdxDrWebBundle:History:ohlc.html.twig', array(
            'chart' => $ob
        ));
    }
    
    /**
     * @return \Ddx\Dr\ReaderBundle\Service\BaseHelper
     */
    protected function getHelper(){
        return $this->get('ddx.helper');
    }
}
