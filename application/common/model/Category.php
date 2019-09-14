<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true; //开启时，自动输入时间戳。

    public function add($data)
    {
        $data['status'] = 1;
        return $this->save($data);
    }

    public function getNormalFirstCategorys($parentId=0)
    {
        $data = [
            'status' => 1,
            'parent_id' => $parentId,
        ];
        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    public function getFirstCategorys($parentId = 0)
    {
        $data = [
            'parent_id' => $parentId,
            'status' => ['neq',-1],
        ];
        $order=[
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $result = $this->where($data)->order($order)->paginate();
        return $result;
    }
}