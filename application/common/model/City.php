<?php

namespace app\Common\model;

use think\Model;

class City extends Model
{
    //
    public function getNomarlCitysByParentId($parent_id=0)
    {
        $data = [
            'status' => 1,
            'parent_id' => $parent_id,
        ];
        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }
}
