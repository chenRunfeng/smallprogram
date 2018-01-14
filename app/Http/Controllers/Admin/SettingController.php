<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    //api
    public function settingApi($type){
        $res = DB::table('setting') -> where([
            'type' => $type
        ]) -> get();
        return response() -> json($res);
    }
    public function index($type){
        $res = DB::table('setting') -> where([
            'type' => $type
        ]) -> paginate(15);
        switch ($type){
            case 0:$typename = '专业信息';break;
            case 1:$typename = '行业信息';break;
            case 2:$typename = '爱好标签';break;
            case 3:$typename = '邀请码';break;
        }
        return view('admin/setting/index') -> with([
            'res' => $res,
            'type' => $type,
            'typename' => $typename
        ]);
    }

    public function addSettingRes(Request $request){
        //先查有没有重复
        $isset = DB::table('setting') -> where([
            'name' => $request -> input('name'),
            'type' => $request -> input('type'),
        ]) -> first();
        //dd($isset);exit;
        if($isset){
            return redirect('admin/setting/'.$request -> input('type')) -> with([
                'isset' => 'yes'
            ]);
        }
        $res = DB::table('setting') -> insert([
            'name' => $request -> input('name'),
            'type' => $request -> input('type'),
            'created_at' => time()
        ]);

        return redirect('admin/setting/'.$request -> input('type')) -> with('insertres','success');
    }

    //删除
    public function deleteSetting($id,$type){
        $res = DB::table('setting') -> where([
            'id' => $id
        ]) -> delete();
        if($res){
            return redirect('admin/setting/'.$type) -> with([
                'deleteres' => 'yes'
            ]);
        }
    }
    public function invitcodeSetting(){
        $res = DB::table('invitcode')  -> where([
            'flag' => 0
        ])-> paginate(15);
        return view('admin/setting/invitcode') -> with([
            'res' => $res
        ]);
    }
    //添加邀请码
    public function addInvitCode(Request $request){
        //先查有没有重复
        $isset = DB::table('invitcode') -> where([
            'code' => $request -> input('invitcode')
        ]) -> first();
        if($isset){
            return redirect('admin/invitcodeSetting') -> with([
                'isset' => 'yes'
            ]);
        }
        DB::table('invitcode') -> insert([
            'code' => $request -> input('invitcode'),
            'creater' => 'admin',
            'createTime' => time(),
            'islose' => 0,
            'flag' => 0
        ]);
        return redirect('admin/invitcodeSetting') -> with('insertres','success');
    }
    //删除邀请码
    public function deleteInvitCode($id){
        $update_res = DB::table('invitcode') -> where([
            'id' => $id
        ]) -> update([
            'flag' => 1
        ]);
        if($update_res){
            return redirect('admin/invitcodeSetting') -> with([
                'deleteres' => 'yes'
            ]);
        }
    }
    //设为有效或者无效
    public function setInvitLose($id){
        //先查状态
        $invit = DB::table('invitcode') -> where([
            'id' => $id
        ]) -> first();
        if($invit->islose == 0){
           $lose = 1;
        }else{
            $lose = 0;
        }
        $update_res = DB::table('invitcode') -> where([
            'id' => $id
        ]) -> update([
            'islose' => $lose
        ]);
        if($update_res){
            return redirect('admin/invitcodeSetting') -> with([
                'setres' => 'yes'
            ]);
        }else{
            return redirect('admin/invitcodeSetting') -> with([
                'setfail' => 'yes'
            ]);
        }
    }
    //设为有效或者无效
    public function getInvotCode(){
        //先查状态
        $invitres = DB::table('invitcode') -> where([
            'islose' => 0,
            'flag' => 0,
        ]) ->pluck('code');
        return response() -> json($invitres);
    }
}
