<?php


namespace app\controller;


use think\facade\Db;
use think\facade\View;
use think\Request;

class Zhiwen extends Common
{
    public function index(Request $request){
        $pageSize = 20;
        $where = [];
        /*if ($this->auth_group_id != 5 && !in_array($this->userId, config('app.ADMINISTRATOR'))) {
            $where[] = ['user_id', '=', $this->userId];
        }*/
        $search = $request->param('search');
        if (!empty($search)) {
            $where[] = ['filters|keyword|supplier|tags|title','like',"%{$search}%"];
        }
        $list = Db::table('zhiwen')->where($where)->paginate($pageSize);
        $data['list'] = $list->items();
        $data['page'] = $list->render();
        return View::fetch('index', $data);
    }
}