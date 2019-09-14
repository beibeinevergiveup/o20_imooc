<?php
namespace app\common\model;

use think\Model;

class Bis extends BaseModel
{
//    protected $autoWriteTimestamp=true;
//
//    public function add($data)
//    {
//        $data['status']=1;
//        $this->save($data);
//        return $this->id;
//    }
 /*
  * 0表示未通过的
  * 1表示
  */
    public function getBisByStatus($status = 0)
    {
        $data = [
            'status' => $status,

        ];
        $order = [
            'id' => 'desc',

        ];

        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
}