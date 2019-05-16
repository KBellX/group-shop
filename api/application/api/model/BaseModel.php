<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    protected $createTime = 'create_at';

    protected $updateTime = 'update_at';

    // 定义全局的查询范围
    protected $globalScope = ['status'];

    public function scopeStatus($query)
    {
        $query->where('data_state',1);
    }

    // 假删除
    public function sDelete()
    {
        $this->save(['data_state' => 0]);
    }
}
