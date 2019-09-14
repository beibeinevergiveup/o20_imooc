<?php
namespace app\common\model;
use think\Exception;
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/5
 * Time: 22:11
 */
class BisAccount extends BaseModel
{
    public function updateById($data,$id)
    {
        return $this->allowField(true)->save($data,['id'=>$id]);
    }
}