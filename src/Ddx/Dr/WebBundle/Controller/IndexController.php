<?php
namespace Ddx\Dr\WebBundle\Controller;
/**
 * IndexController.php UTF-8
 * @author Allan IRDEL
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller{

    /**
     * route /kraken/history
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function krakenHistoryAction(){
        $kraken = $this->getHelper()->getMarketRepository()->findOneBy(array('name' => 'Kraken'));
        $tradingRepo = $this->getHelper()->getTradeRepository();
        
        $allTrades = $kraken->getTrades();
        $avg5 = $tradingRepo->getWeightedData($kraken, $kraken->getActiveTradingPairs()->first(), 300);

        return $this->render('DdxDrWebBundle:History:index.html.twig', array(
            'allTrades' => $allTrades,
            'vwapData' => $avg5
        ));
    }

    /**
     * @return \Ddx\Dr\ReaderBundle\Service\BaseHelper
     */
    protected function getHelper(){
        return $this->get('ddx.helper');
    }
}
