<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2018/1/13
 * Time: 14:48
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    //创建或者更新公告
    public function addNotice(Request $request){
        if(!$request -> input('id')){
            //添加公告
            //计算公告置顶
            $zhiding = 0;
            if ($request -> input('zhiding') != 0){
                $notice = DB::table('notice')->where('zhidingNum', '<>', 0)->orderBy('zhidingNum', 'desc')->first();
                $zhiding = intval($notice->zhidingNum) + 1;
            }
            $id_res = DB::table('notice') -> insertGetId([
                'title' => $request -> input('title'),
                'content' => $request -> input('content'),
                'xiaoyouid' => $request -> input('xiaoyou_id'),
                'creater' => $request -> input('openid'),
                'createTime' => $request -> time(),
                'zhidingNum' => $zhiding,
                'flag' => 0
            ]);
            if($id_res){
                echo $id_res;
            }else{
                echo 'error';
            }
        }else{
            //更新公告
            $zhiding = 0;
            if ($request -> input('zhiding') != 0){
                $notice = DB::table('notice')->where('zhidingNum', '<>', 0)->orderBy('zhidingNum', 'desc')->first();
                $zhiding = intval($notice->zhidingNum) + 1;
            }
            $update_res = DB::table('notice')
                ->where('id', $request -> input('id'))
                ->update([
                    'title' => $request -> input('title'),
                    'content' => $request -> input('content'),
                    'editTime' => $request -> time(),
                    'zhidingNum' => $zhiding,
                ]);
            if($update_res){
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    //删除公告
    public function deleteNotice(Request $request){
        $update_res = DB::table('notice')
            ->where('id', $request -> input('id'))
            ->update([
                'flag' => 1,
            ]);
        if($update_res){
            echo 'success';
        }else{
            echo 'error';
        }
    }
    //查询公告
    public function getNotice(Request $request){

        if($request -> input('id')){
            //根据公告ID查询公告信息
            $notice = DB::table('notice') ->select(DB::raw('* , from_unixtime(createTime,\'%Y-%m-%d %H:%i:%S\') as create_time'))
                -> where([
                'id' => $request -> input('id'),
                'flag' => 0
            ])->first();
        }else if($request -> input('xiaoyou_id')){
            //根据校友会id查询公告列表
            $notice = DB::table('notice') ->select(DB::raw('* , from_unixtime(createTime,\'%Y-%m-%d %H:%i:%S\') as create_time'))
                -> where([
                'xiaoyouid' => $request -> input('xiaoyou_id'),
                'flag' => 0
            ]) ->get();
        }
        return response() -> json($notice);
    }
}