<?php

namespace app\common\model;

use think\Exception;

/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/5
 * Time: 22:02
 */
class BisLocation extends BaseModel
{
    public function getBisByBisId($bisid)
    {
        $data = [
            'status' => ['neq', -1],
            'bis_id' => $bisid,
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $result = $this->where($data)->order($order)->paginate();
        return $result;
    }

    public function getNormalBisLocation($locationId = 0, $main = 0)
    {
        if ($locationId) {
            $data = [
                'bis_id' => $locationId,
                'status' => ['neq', -1],
                'is_main' => $main,
            ];
            $order = [
                'listorder' => 'desc',
                'id' => 'desc',
                ];
                $result = $this->where($data)->order($order)->paginate();
        }else{
        $data = [
            'status' => ['neq', -1],
            'is_main' => $main,
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $result = $this->where($data)->order($order)->paginate();
        }
        return $result;
    }

    public function getDealLocation($locationId)
    {
        $data = [
            'bis_id' => $locationId,
            'status' => ['eq', 1],

        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
       return $result = $this->where($data)->order($order)->paginate();
    }

    public function getLocationByBisId($bisId)
    {
        $data = [
            'bis_id' => $bisId,
            'status' => ['eq', 1],

        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        return $this->where($data)->order($order)->select();
    }

}