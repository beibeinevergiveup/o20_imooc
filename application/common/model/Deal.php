<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/21
 * Time: 12:12
 */

namespace app\common\model;


class Deal extends BaseModel
{
    /*
     * 团购商品列表
     */
    public function getLocationNormalDeals($id)
    {
        $data = [
            'status' => ['neq', -1],
            'bis_id' => $id,
        ];
        $order = [
            'id' => 'desc',

        ];
        return $this->where($data)->order($order)->select();
    }

    /*
     * 主后台页面获取商品列表
     */
    public function getDeals($sdata = [])
    {
        $data = $sdata;
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }

    /**
     * @param $id 分类id
     * @param $cityPath 城市id
     * @param int $limit
     * @user beibei
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNormalDealByCategoryCityId($id, $cityPath, $limit = 10)
    {
        $data = [
            'end_time' => ['gt', time()],
            'category_id' => $id,
            'city_path' => $cityPath,
            'status' => 1
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $result = $this->where($data)->order($order);
        if ($limit) {
            $result = $result->limit($limit);
        }
        return $result->select();
    }

    /**
     * @param array $data
     * @param $orders
     * @user beibei
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getDealsByConditions($data = [], $orders)
    {
        $order = [];
        if (!empty($orders['buy_count'])) {
            $order['buy_count'] = 'desc';
        }
        if (!empty($orders['create_time'])) {
            $order['create_time'] = 'desc';
        }
        if (!empty($orders['current_price'])) {
            $order['current_price'] = 'desc';
        }
        $data[] = "end_time > " . time();
        if (!empty($data['se_category_id'])) {
            $data[] = "find_in_set(" . $data['se_category_id'] . ",se_category_id)";
        }
        if (!empty($data['category_id'])) {
            $data[] = 'category_id =' . $data['category_id'];
        }
        if (!empty($data['city_id'])) {
            $data[] = 'city_id =' . $data['city_id'];
        }
        $data[] = 'status = 1';

        $result = $this->where(implode(' AND ',$data))->order($order)->paginate();
        return $result;


    }
}