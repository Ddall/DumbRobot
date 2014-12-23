<?php

namespace Ddx\Dr\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DdxDrUserBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent() {
        return 'FOSUserBundle';
    }
}
