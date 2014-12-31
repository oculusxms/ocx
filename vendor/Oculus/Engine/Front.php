<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Oculus\Engine;
use Oculus\Engine\Container;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;

final class Front {
    private $app;
    private $pre_action = array();
    private $error;
    
    public function __construct(Container $app) {
        $this->app = $app;
        
        foreach ($app['pre.actions'] as $pre_action):
            $this->pre_action[] = new Action(new ActionService($app, $pre_action));
        endforeach;
    }
    
    public function addPreAction($pre_action) {
        $this->pre_action[] = $pre_action;
    }
    
    public function dispatch($action, $error) {
        $this->error = $error;
        foreach ($this->pre_action as $pre_action):
            $result = $this->execute($pre_action);
            if ($result):
                $action = $result;
                break;
            endif;
        endforeach;
        
        while ($action):
            $action = $this->execute($action);
        endwhile;
    }
    
    private function execute($action) {
        $result = $action->execute($this->app);
        
        if (is_object($result)):
            $action = $result;
        elseif ($result === false):
            $action = $this->error;
            $this->error = '';
        else:
            $action = false;
        endif;
        
        return $action;
    }
    
    public function output() {
        $this->app['response']->output();
    }
}
