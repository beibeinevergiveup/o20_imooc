<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/28
 * Time: 6:57
 */
namespace app\index\controller;
use  think\Controller;

class Base extends Controller
{
    public $city = '';
    public $account = '';
    public $title = 'o2o_首页';
    public function _initialize()
    {
        $citys = model('City')->getSecondCitys();
        $this->getCity($citys);
        $this->assign('city', $this->city);
        $this->assign('citys', $citys);
        $cats = $this->getRecommendCats();
        $this->assign('cats', $cats);
        $this->assign('title', $this->title);
        $this->assign('user', $this->getLoginUser());
        $this->assign('controller', strtolower(request()->controller()));

    }


    public function getCity($citys)
    {
        $defaultname = '';
        foreach ($citys as $v) {
            $city = $v->toArray();
            if ($city['is_default']==1) {
                $defaultname = $city['name'];
                break;
            }
        }
        $defaultname = $defaultname ? $defaultname : '泉州';
        if (session('cityname', '', 'o2o')&&!input('get.city')) {
            $cityname = session('cityname', '', 'o2o');
        }else{
            $cityname = input('get.city', $defaultname, 'trim');
            session('cityname', $cityname, 'o2o');
        }
        $this->city = model('City')->where(['name' => $cityname])->find();
    }

    public function getLoginUser()
    {
        if (!$this->account) {
            $this->account = session('o2o_user', '', 'o2o');
        }
        return $this->account;
    }

    public function getRecommendCats()
    {
        $parenIds = $sedcatArr = $recomCats = [];
        $cats = model('Category')->getNormalRecommendCategoryByParentId(0, 5);
        foreach ($cats as $v) {
            $parenIds[] = $v->id;
        }
        //获取二级分类数据
        $seCats = model('Category')->getNormalCategoryIdParentId($parenIds);
        foreach ($seCats as $v) {
            $sedcatArr[$v->parent_id][] =[
                'id' => $v->id,
                'name' => $v->name,
            ];
        }
        foreach ($cats as $v) {
            $recomCats[$v->id] = [
                $v->name,
                empty($sedcatArr[$v->id]) ? [] : $sedcatArr[$v->id],
            ];
        }
        return $recomCats;
    }
}