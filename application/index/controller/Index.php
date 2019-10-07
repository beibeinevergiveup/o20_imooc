<?php
namespace app\index\controller;
use  think\Controller;
class Index extends Base
{
    public function index()
    {

        $Bigfeatured = model('Featured')->getIndexNormalFeaturedByType(0);
        $Smallfeatured= model('Featured')->getIndexNormalFeaturedByType(1);
        $foodlist = model('Deal')->getNormalDealByCategoryCityId(1,$this->city->id);
        $foodcategory = model('Category')->getNormalCategoryIdParentId([1]);
        return $this->fetch('',[
            'bigfeatured' => $Bigfeatured,
            'smallfeatured' => $Smallfeatured,
            'foodlist' => $foodlist,
            'foodcategory' => $foodcategory,

        ]);

    }
}
