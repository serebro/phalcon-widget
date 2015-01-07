<?php

namespace Serebro\Widget;

use Serebro\Widget;

class Demo extends Widget
{

    public $parameter = 'demo';

    
    public function run()
    {
        return $this->render('demo', [
            'parameter' => $this->parameter
        ]);
    }
}
