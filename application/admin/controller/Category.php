<?php

namespace app\admin\controller;

use think\Controller;

class Category extends Controller
{
    private $obj;

    public function _initialize()
    {
        $this->obj = model('Category');
    }

    public function index()
    {
        $parentId = input('get.parent_id', '0', 'intval');
        $categorys = $this->obj->getFirstCategorys($parentId);
        return $this->fetch('', [
            'categorys' => $categorys,

        ]);
    }

    public function add()
    {
        $category = $this->obj->getNormalFirstCategorys();
        return $this->fetch('', [
            'categorys' => $category,
        ]);
    }

    public function save()
    {
        if (!request()->isPost()) {
            $this->error('请求失败');
        }//严格判定
        //print_r(input('post.'));
        $data = input('post.');
        //$data['status'] = 100;
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }
        if (!empty($data['id'])) {
            $this->obj->update($data);
            $this->success('修改成功');
        }
        $res = $this->obj->add($data);
        if ($res) {
            $this->success('新增成功');
        } else {
            $this->error('新增失败');
        }
    }

    public function edit($id = 0)
    {
        if (intval($id) < 0) {
            $this->error('参数不合法');
        }

        $category = $this->obj->get($id);
        $categorys = $this->obj->getNormalFirstCategorys();

        return $this->fetch('', [
            'category' => $category,
            'categorys' => $categorys,

        ]);
    }

    public function listorder($id, $listorder)
    {
        //$_SERVER['HTTP_REFERER'] 获取前一页面的地址
        $res = $this->obj->save(['listorder' => $listorder], ['id' => $id]);
        if ($res) {
            $this->result($_SERVER['HTTP_REFERER'], 1, '更新成功');
        } else {
            $this->result($_SERVER['HTTP_REFERER'], 0, '更新失败');
        }
    }

    public function status()
    {
        $data = input('get.');
        $validate = validate("Category");
        if (!$validate->scene("status")->check($data)) {
            $this->error($validate->getError());
        }
        $res = $this->obj->save(['status' => $data['status']], ['id' => $data['id']]);
        if ($res) {
            $this->success("状态更新成功");
        } else {
            $this->error("状态更新失败");
        }
    }

}
