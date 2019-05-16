<?php

namespace app\api\controller;

use think\Controller;

// class BaseController 
class BaseController extends Controller
{
    protected $defaultPageIdx = 1;

    protected $defaultPageSize = 30; 

    protected function buildConditions($allowFields)
    {
        $conditions = $this->request->only($allowFields);
        $rConditions = [];
        foreach ($conditions as $k => $v) {
            if ($v) {
                $rConditions[$k] = $v;
            }
        }
        return $rConditions;
    }



}
