<?php
/**
 * User: beibei
 * Date: 2019/10/2
 * Time: 11:01
 */

namespace app\index\controller;

class Detail extends Base
{
    public $num = 0;
    public function index()
    {
        $id = input('get.id');
        if (!intval($id)) {
            $this->error('error');
        }
        $data = model('Deal')->get(['id' => $id]);
        if (!$data || $data->status != 1) {
            $this->error('该商品不存在');
        }
        $bis_id = $data->bis_id;
        $locations = model('bis_location')->getLocationByBisId($bis_id);
        $bis = model('bis')->get(['id'=>$bis_id,'status'=>1]);
        $this->assign('title', $data->name);
        $flag = 0;
        if ($data->start_time > time()) {
            $flag = 1;
        }
        $over_count = $data->total_count - $data->buy_count;
        return $this->fetch('', [
            'deal' => $data,
            'flag' => $flag,
            'over_count' => $over_count,
            'xypoint' => $locations[0]->xpoint.','.$locations[0]->ypoint,
            'bis' => $bis,
            'locations' => $locations,
            'id' => $id
            //'bis' =>

        ]);
    }

    public function getTime()
    {
        $id = input('get.id');
        if (!intval($id)) {
            $this->error('error');
        }
        $data = model('Deal')->get(['id' => $id]);
        if ($data->start_time > time()) {
            $flag = 1;
            $dtime = $data->start_time - time();
            $timedata = '';
            //floor() 向下取整
            $d = floor($dtime / (3600 * 24)); //取剩余天数
            if ($d) {
                $timedata .= $d . '天';
            }
            $h = floor($dtime % (3600 * 24) / 3600);
            if ($h) {
                $timedata .= $d . '小时';
            }
            $m = floor($dtime % (3600 * 24) % 3600 / 60);
            if ($m) {
                $timedata .= $m . '分';
            }
            $s = floor($dtime % (3600 * 24) % 3600 %60);
            if ($s) {
                $timedata .= $s . '秒';
            }
            return show('1', 'success', [
                'num' => $timedata
            ]);
        }
    }


}