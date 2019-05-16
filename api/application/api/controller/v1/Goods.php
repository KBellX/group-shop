<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use think\Request;
use app\api\model\Goods as GoodsModel;
use app\api\service\Goods as GoodsService;

class Goods extends BaseController
{
    protected $middleware = [ 
        // 'Auth'
    ];

    public function lists(Request $res)
    {
        $pageIdx = $res->page ? $res->page : $this->defaultPageIdx;
        $pageSize = $res->limit ? $res->limit : $this->defaultPageSize;
        $conditions = $this->buildConditions(['name', 'cate_id']);
        $data = GoodsModel::getList($pageIdx, $pageSize, $conditions);
        return success($data);
    }

    public function index(Request $res)
    {
        $pageIdx = $res->page_idx ? $res->page : $this->defaultPageIdx;
        $pageSize = $res->page_size ? $res->limit : $this->defaultPageSize;
        $conditions = $this->buildConditions(['name']);
        $data = GoodsModel::getFullList($pageIdx, $pageSize, $conditions);
        return success($data);
    }

    public function read(Request $res)
    {
        $goods = GoodsModel::getDetail($res->id);
        return success($goods);
    }

    public function grouping($id)
    {
        $goodsService = new GoodsService();       
        $list = $goodsService->getGroupingList($id);

        return success($list);
    }
}
