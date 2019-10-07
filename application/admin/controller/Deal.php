<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/22
 * Time: 14:23
 */
namespace app\admin\controller;
use think\Controller;

class Deal extends Controller
{
    public function index()
    {
        $data = input('get.');
        $sdata = [];
        if (!empty($data['start_time'])&&!empty($data['end_time'])
            &&strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['start_time'] = [
                ['>', strtotime($data['start_time'])],
                ['<', strtotime($data['end_time'])],
            ];
        }
        if (!empty($data['city_id'])) {
            $sdata['city_path'] = $data['city_id'];
        }
        if (!empty($data['category_id'])) {
            $sdata['category_id'] = $data['category_id'];
        }
        if (!empty($data['name'])) {
            $sdata['name'] = ['like', '%' . $data['name'] . '%'];
        }
        $deals = model('Deal')->getDeals($sdata);
        $citys = model('City')->getSecondCitys();
        $categorys = model('Category')->getNormalFirstCategorys();
        $catearr = $cityarr = [];

        foreach ($categorys as $category) {
            $catearr[$category->id] = $category->name;
        }
        foreach ($citys as $city) {
            $cityarr[$city->id] = $city->name;
        }
        return $this->fetch('', [
            'citys' => $citys,
            'categorys' => $categorys,
            'deals' => $deals,
            'cityarr' => $cityarr,
            'catearr' => $catearr,
            'city_id' => empty($data['city_id']) ? 0:$data['city_id'],
            'category_id' => empty($data['category_id']) ? 0:$data['category_id'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'name' => empty($data['name']) ? '' : $data['name'],


        ]);
    }

    /**
     * @user beibei
     * @return void
     */
    public function status()
    {
        $data = input('get.');
        $res = model('Deal')->save(['status' => $data['status']], ['id' => $data['id']]);
        if ($res) {
            $this->success("状态更新成功");
        } else {
            $this->error("状态更新失败");
        }
    }

}