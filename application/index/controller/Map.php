<?php
/**
 * User: beibei
 * Date: 2019/10/2
 * Time: 13:01
 */
namespace app\index\controller;
use  think\Controller;

class Map extends Controller
{
    public function getMapImage($data)
    {
        return \Map::staticimage($data);
    }
}