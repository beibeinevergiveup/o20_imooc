<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/13
 * Time: 0:24
 */
namespace app\bis\controller;
use think\Controller;

class Location extends Base
{
    public function index()
    {
        $bisid = $this->getLoginUser()->bis_id;
        $bis = model('BisLocation')->getBisByBisId($bisid);
        return $this->fetch('',
            [
                'bis' => $bis,
            ]);
    }

    public function add()
    {
        if (request()->isPost()) {
            //$this->error('请求错误');

            $data = input('post.');
            $validate = validate('Bis');
            if (!$validate->scene('addLocation')->check($data)) {
                $this->error($validate->getError());
            }
            $lnglat = \Map::getLngLat($data['address']);
            $lnglat = json_decode($lnglat, true);
            if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1) {
                $this->error('无法获取数据， 或者匹配的地址不精确');
            }
//        print_r($lnglat); exit;
            $bisId = $this->getLoginUser()->bis_id;
            $data['cat'] = '';
            if (!empty($data['se_category_id'])) {
                $data['cat'] = implode('|', $data['se_category_id']);
            }
            // 总店相关信息入库
            $locationData = [
                'bis_id' => $bisId,
                'name' => $data['name'],
                'logo' => $data['logo'],
                'tel' => $data['tel'],
                'contact' => $data['contact'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'] . ',' . $data['cat'],
                'city_id' => $data['city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
                'api_address' => $data['address'],
                'open_time' => $data['open_time'],
                'content' => empty($data['content']) ? '' : $data['content'],
                'is_main' => 0,// 1,代表的是总店信息 0,表示分店
                'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
                'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
            ];
            $locationId = model('BisLocation')->add($locationData);

            if ($locationId) {
                $this->success('门店申请成功');
            }else{
                $this->error('门店申请失败');
            }

        }else{
            $citys = model('City')->getNomarlCitysByParentId();
            $categorys = model('Category')->getNormalFirstCategorys();
            return $this->fetch('',
                [
                    'citys' => $citys,
                    'categorys' => $categorys,
                ]);
        }

    }

    public function detail()
    {
        $id = input('get.id');
        $locationData = model('BisLocation')->get(['id' => $id]);
        $citys = model('City')->getNomarlCitysByParentId();
        $categorys = model('Category')->getNormalFirstCategorys();
        $category_info = $this->getCategoryInfo($id);
        return $this->fetch('',
            [
                'locationData' => $locationData,
                'citys' => $citys,
                'categorys' => $categorys,
                'category_info'=>$category_info

            ]);
    }

    public function getCategoryInfo($id)
    {
        $locationData = model('BisLocation')->get(['id' => $id]);
        $category_path_all = $locationData['category_path'];
        $category_path = explode(',', $category_path_all);
        foreach ($category_path as $k => $v){
            if ($k == 0) {
                unset($category_path[$k]);
            }
        }
        $category_path = array_values($category_path); //设置数组从0开始；
        foreach ($category_path as $k => $v){
            $category_path_name[$k] = model('Category')->get($category_path[$k])['name'];

        }
        foreach ($category_path_name as $k => $v) {
            foreach ($category_path as $kk => $vv) {
                if ($k == $kk) {
                    $category_info[$vv] = $v;
                }
            }
        }
        return $category_info;
    }



}