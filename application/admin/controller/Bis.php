<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/8
 * Time: 1:19
 */
namespace app\admin\controller;

use think\Controller;

class Bis extends Controller
{
    protected $obj = '';
    public function _initialize()
    {
        $this->obj = model('Bis');
    }

    public function index()
    {
        $list = $this->obj->getBisByStatus(1);
        return $this->fetch('',
            [
                'bis' => $list,

            ]
        );
    }
    public function apply()
    {
        $list = $this->obj->getBisByStatus();
        return $this->fetch('',
            [
                'bis' => $list,

            ]
            );
    }

    public function applybis()
    {
        $locationData = model('BisLocation')->getNormalBisLocation();
        foreach ($locationData as $k => $v) {
            $v['bis_name'] = model('bis')->get(['id' => $v['bis_id']])['name'];
        }
        return $this->fetch('', [
            'location' => $locationData,
        ]);
    }
    public function deteledbis()
    {
        $list = $this->obj->getBisByStatus(-1);
        return $this->fetch('',
            [
                'bis' => $list,

            ]
        );
    }

    public function detail()
    {
        $id = input('get.id');
        if(empty($id)){
            $this->error('Id错误');
        }
        $citys = model('City')->getNomarlCitysByParentId();
        $categorys = model('Category')->getNormalFirstCategorys();
        $category_info = $this->getCategoryInfo($id);
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
       # $categorys_info =

        return $this->fetch('',
            [
                'citys' => $citys,
                'categorys' => $categorys,
                'bisData' => $bisData,
                'locationData' => $locationData,
                'accountData' => $accountData,
                'category_info' => $category_info
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


    /*
     * 修改审核状态
     */
    public function status()
    {
        $data = input('get.');
        $res = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        $location = model('BisLocation')
            ->save(['status'=>$data['status']],['bis_id'=>$data['id'], 'is_main' => 1,]);
        $account = model('BisAccount')
            ->save(['status'=>$data['status']],['bis_id'=>$data['id'], 'is_main' => 1,]);
        if ($res && $location && $account) {
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }
    public function BisStatus(){
        $data = input('get.');
        $location = model('BisLocation')
            ->save(['status'=>$data['status']], ['is_main' => 0,'id'=>$data['id']]);
        if ($location) {
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }
}