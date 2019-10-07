<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/24
 * Time: 13:34
 * 推荐位数据库处理
 */

namespace app\common\model;


class Featured extends BaseModel
{
    //根据type类型获取推荐位数据
    public function getNormalFeaturedByType($type = -1)
    {
        $data = [
            'status' => ['neq',-1]
        ];
        if ($type != -1) {
            $data = [
                'status' => ['neq',-1],
                'type' => $type,

            ];
        }
        return $this->where($data)->select();
    }

    public function getIndexNormalFeaturedByType($type = -1)
    {
        $data = [
            'status' => ['eq',1]
        ];
        if ($type != -1) {
            $data = [
                'status' => ['eq',1],
                'type' => $type,

            ];
        }
        return $this->where($data)->select();
    }
}
