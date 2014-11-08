<?php

namespace Dr\Ddx\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DrDdxMarketBundle:Default:index.html.twig', array('name' => $name));
    }
}
