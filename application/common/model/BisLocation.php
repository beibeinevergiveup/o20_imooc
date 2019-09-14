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
            'status' => ['neq',-1],
            'bis_id' => $bisid,
        ];
        $order=[
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $result = $this->where($data)->order($order)->paginate();
        return $result;
    }
}