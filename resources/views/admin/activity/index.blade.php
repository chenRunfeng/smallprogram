@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">活动列表</h1>
        
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/exportExcel') }}">导出活动</a></li>
        </ol>
        
        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">活动名称</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">活动简介</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">活动地点</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">绑定校友会</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">添加人</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">报名人数</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo -> id}}</td>
                            <td>{{$vo -> title}}</td>
                            <td>{{$vo -> content}}</td>
                            <td>{{$vo -> address}}</td>
                            <td>@if($vo -> xiaoyou_info){{$vo -> xiaoyou_info -> name}}@endif</td>
                            <td>@if($vo -> user_info){{$vo -> user_info -> name}}@endif</td>
                            <td>{{$vo -> baoming}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td><a href="{{ url('admin/exportPersonList').'/'.$vo -> id }}" style="background-color:lightgreen;">导出名单</a></td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
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

    </script>

@stop