<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function show($status, $message = '', $data = [])
{
    return json([
        'status' => intval($status),
        'message' => $message,
        'data' => $data,
    ]);
}
function showarr($status, $message = '', $data = [])
{
    return [
        'status' => intval($status),
        'message' => $message,
        'data' => $data,
    ];
}

function status($status)
{
    if ($status == 1) {
        $str = "<span class='label label-success radius'>正常</span>";
    } elseif ($status == 0) {
        $str = "<span class='label label-danger radius'>待审</span>";
    } elseif ($status == 2) {
        $str = "<span class='label label-danger radius'>不通过</span>";
    } else {
        $str = "<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}

function doCurl($url, $type = 0, $data = [])
{
    $ch = curl_init(); // 初始化
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if ($type == 1) { // post
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    // 执行并获取内容
    $output = curl_exec($ch);
    // 释放curl句柄
    curl_close($ch);
    return $output;
}

function pagination($pagination)
{
    if (!$pagination) {
        return "";
    }
    $parm = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-nuomi">' . $pagination->appends($parm)->render() . '</div>';
}


function getSetCityName($path)
{
    if (empty($path)) {
        return '';
    }
    if (preg_match('/,/', $path)) {
        $cityPath = explode(',', $path);
        $cityPath = $cityPath[1];
    } else {
        $cityPath = $path;
    }

    $city = model('City')->get($cityPath);

    return $city->name;


}

/**
 * @param $data
 * @user beibei
 * @return int
 */
function countLocation($data)
{
    $arr = explode(',',$data);
    return count($arr);
}

/**
 * @param $id
 * @return mixed
 * @throws \think\exception\DbException
 * @user beibei
 */
function getCategory($id)
{
    $arr = model('Category')->get(['id'=> $id]);
    return $arr->name;
}