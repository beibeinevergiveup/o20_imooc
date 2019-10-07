<?php
namespace app\common\model;


class User extends BaseModel{
    public function add($data=[])
    {
        if (!is_array($data)) {
            exception('参数不合法');
        }
        $id = $this->where(['username'=>$data['username'],'status'=>['eq',1]])->find();
        if($id){
            exception('该用户已经注册');
        }
        $id = $this->where(['email' => $data['email'],'status'=>['eq',1]])->find();
        if ($id) {
            exception('该邮箱已经存在');
        }
        return $this->allowField(true)->save($data);

    }

    public function getUserByUsername($data)
    {
        if (!is_array($data)) {
            exception('数值不合法');
        }
        $username = $data['username'];
        return $this->where(['username' => $username, 'status' => 1,])->find();

    }


}
