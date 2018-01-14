@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;z-index: 0;" >

        <h1 class="page-header">邀请码配置列表</h1>
        <ol class="breadcrumb">
            <li><a data-toggle="modal" data-target="#addSetting">新增</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-code"></span> <span class="visible-lg">邀请码</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">创建者</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-isclosed"></span> <span class="visible-lg">是否有效</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo -> id}}</td>
                            <td>{{$vo -> code}}</td>
                            <td>{{$vo -> creater}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> createTime) }}</td>
                            <td>{{$vo -> islose == 0 ? '有效':'无效'}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        操作 <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="z-index: 1;">
                                        <li><a href="{{ url('admin/setInvitLose/'.$vo -> id)}}" onclick="setting()">设为{{$vo -> islose == 0 ? '无效':'有效'}}</a></li>
                                        <li><a href="{{ url('admin/deleteInvitCode/'.$vo -> id)}}" onclick="deleted()">删除</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--增加邀请码-->
    <div class="modal fade " id="addSetting" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="{{ url('admin/addInvitCode') }}" method="post" autocomplete="off" draggable="false" id="myAddShequForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >添加邀请码</h4>
                </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>

                            <tr>
                                <td wdith="30%">邀请码:</td>
                                <td width="70%"><input type="text" value="" class="form-control" id="invitcode" name="invitcode" maxlength="10" autocomplete="off" required/></td>
                            </tr>

                            {{ csrf_field() }}
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <script>
        @if (session('insertres'))
            alert('添加成功！');
        @endif
        @if (session('deleteres'))
            alert('删除成功！');
        @endif

        @if (session('isset'))
            alert('已存在！');
        @endif
        @if (session('setres'))
            alert('设置成功！');
        @endif
        @if (session('setfail'))
            alert('设置失败！');
        @endif

    </script>
    <script>
        $(function(){
            @if (session('show'))
                $('#editShequ').modal('show')
            @endif

            //数据验证
            $('#myAddShequForm').submit(function(){
                if($.trim($('#myAddShequForm input[name=password]').val()) && $.trim($('#myAddShequForm input[name=password]').val()) != $.trim($('#myAddShequForm input[name=new_password]').val())){
                    alert('两次填写密码不一致');return false;
                }
            })
        })
        function setting() {
            //利用对话框返回的值 （true 或者 false）
            if (confirm("你确定设置吗？")) {
                return true
            }
            else {
                return false;
            }

        }
        function deleted() {
            //利用对话框返回的值 （true 或者 false）
            if (confirm("你确定删除吗？")) {
                return true
            }
            else {
                return false;
            }

        }
    </script>
@stop