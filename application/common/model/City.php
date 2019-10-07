<?php

namespace app\Common\model;

use think\Model;

class City extends BaseModel
{
    //
    public function getNomarlCitysByParentId($parent_id=0)
    {
        $data = [
            'status' => 1,
            'parent_id' => $parent_id,
        ];
        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    /*
     * 获取次级城市
     */
    public function getSecondCitys()
    {
        $data = [
            'status' => 1,
            'parent_id' => ['neq', '0'],
        ];

        return $this->where($data)->select();
    }


    public function saveCityByAdmin($data)
    {
        $city = $data['city'];
        $province = $data['province'];
        $result = $this->where(['name' => $province])->find();
        if ($result) {
            $result1 = $this->where(['name' => $city])->find();
            if ($result1) {
                return showarr(0, '该城市已经添加');
            }else{
                $data = [
                    'parent_id' => $result['id'],
                    'name' => $city,
                    'status' => 1,
                ];
                $result2 = $this->save($data);
                if ($result2) {
                    return showarr(1, '添加成功');
                } else {
                    return showarr(0, '添加失败');

                }
            }
        }else{
            $data1 = [
                'parent_id' => 0,
                'name' => $province,
                'status' => 1,
            ];

            $result1 = $this->insertGetId($data1);
            $data2 = [
                'parent_id' => $result1,
                'name' => $city,
                'status' => 1,
            ];
            $result2 = $this->save($data2);
            if ($result1&&$result2) {
                return showarr(1, '添加成功');

            }
        }
    }
}
