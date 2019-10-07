<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/25
 * Time: 12:42
 * 城市管理页面
 */
namespace app\admin\controller;
use think\Controller;

class City extends Controller
{

    public function index()
    {
        $parent_id = input('get.parent_id', '0', 'intval');
        $citys = model('City')->getNomarlCitysByParentId($parent_id);

        return $this->fetch('',[
            'citys' => $citys,
            'parent_id' => $parent_id,


        ]);

    }

    public function add()
    {

        $all_citys = config('city');

        return $this->fetch('', [
                'province' => $all_citys,
        ]);
    }
//获取所属省份的所有地区
    public function getCitys()
    {
        $province = input('post.province');
        if (!$province && empty($province)) {
            $this->error('error');
        }
        $all_citys = config('city');
        $citys = [];
        foreach ($all_citys as $k => $v) {
            if ($province == $k) {
                $citys = $v;
            }
        }
        return show(1, 'success', $citys);

    }

    public function save()
    {
        $data = input('post.');
        if (!$data) {
            $this->error('error');

        }
        if ($data['city'] == '0' || $data['province']=='0') {
            $this->error('请选择正确的省份或城市');
        }
        $result = model('City')->saveCityByAdmin($data);

        if ($result['status']) {
            $this->success($result['message']);
        }else{
            $this->error($result['message']);
        }
    }
}