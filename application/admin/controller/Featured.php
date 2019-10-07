<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/24
 * Time: 13:18
 * 用于推荐位列表开发
 */

namespace app\admin\controller;

use think\Controller;

class Featured extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $id = model('Featured')->add($data);
            if ($id) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        } else {
            $featured_type = config('featured.featured_type');

            return $this->fetch('', [
                'featured' => $featured_type,
            ]);
        }
    }


    public function index()
    {
        $type = -1;
        if (request()->isPost()) {
            $type = input('post.type');
        }
        $featured_type = config('featured.featured_type');
        $featured_list = model('Featured')->getNormalFeaturedByType($type);
        return $this->fetch('', [
            'type' => $type,
            'featured' => $featured_type,
            'featured_list' => $featured_list
        ]);
    }

    public function status()
    {
        $data = input('get.');
        if (empty($data)) {
            $this->error('error');
        }
        $id = model('Featured')->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($id) {
            $this->success('更新成功');
        } else {
            $this->error('更新失败');
        }
    }
}