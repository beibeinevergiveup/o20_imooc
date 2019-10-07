<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/21
 * Time: 11:52
 */

namespace app\bis\controller;
class Deal extends Base
{
    protected $obj;

    public function _initialize()
    {
        $this->obj = model('Deal');
    }

    public function index()
    {
        $bis_id = $this->getLoginUser()->bis_id;
        $DealList = model('Deal')->getLocationNormalDeals($bis_id);

        return $this->fetch('', [
            'DealList' => $DealList,

        ]);

    }

    public function add()
    {
        $bisId = $this->getLoginUser()->bis_id;
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('Deal');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $location = model('BisLocation')->get($data['location_ids'][0]);
            $deals = [
                'bis_id' => $bisId,
                'name' => $data['name'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'se_category_id' => empty($data['se_category_id']) ? '' : implode(',', $data['se_category_id']),
                'city_id' => $data['city_id'],
                'city_path' => $data['se_city_id'],
                'location_ids' => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
                'start_time' => strtotime($data['start_time']),
                'end_time' => strtotime($data['end_time']),
                'coupons_begin_time' => strtotime($data['coupons_begin_time']),
                'coupons_end_time' => strtotime($data['coupons_end_time']),
                'notes' => $data['notes'],
                'description' => $data['description'],
                'bis_account_id' => $this->getLoginUser()->id,
                'current_price' => $data['current_price'],
                'origin_price' => $data['origin_price'],
                'total_count' => $data['total_count'],
                'xpoint' => $location->xpoint,
                'ypoint' => $location->ypoint,


            ];

            $id = model('Deal')->add($deals);
            if ($id) {
                $this->success('团购商品已经提交，待审核');
            }


        } else {
            $citys = model('City')->getNomarlCitysByParentId();
            $categorys = model('Category')->getNormalFirstCategorys();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,
                'bisLocations' => model('BisLocation')->getDealLocation($bisId),
            ]);
        }
    }
}