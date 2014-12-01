<?php
namespace Ddx\Dr\WebBundle\Controller;
/**
 * IndexController.php UTF-8
 * @author Allan IRDEL
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function krakenHistoryAction(){
        $trades = $this->getDoctrine()->getManager()->getRepository('DdxDrMarketBundle:Market')->findOneBy(array('name' => 'Kraken'))->getTrades();
        
        return $this->render('DdxDrWebBundle:History:index.html.twig', array(
            'data' => $trades,
        ));
    }

}
