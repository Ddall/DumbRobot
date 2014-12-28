<?php
namespace Ddx\Dr\WebBundle\Controller;
/**
 * MarketController.php UTF-8
 * @author Allan IRDEL
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketController extends Controller {

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function marketsIndexAction(){
        $markets = $this->getHelper()->getMarketRepository()->findAll();
        
        return $this->render('DdxDrWebBundle:Market:marketsIndex.html.twig', array(
            'markets' => $markets
        ));
    }
    
    /**
     * @return \Ddx\Dr\ReaderBundle\Service\BaseHelper
     */
    protected function getHelper(){
        return $this->get('ddx.helper');
    }
    
}
