<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/5
 * Time: 21:59
 */
namespace app\common\model;
use think\Model;
/*
 * 公共模块
 * */
class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
}
