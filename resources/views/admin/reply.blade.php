<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>后台管理</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ URL::asset('/css/bootstrapAdmin.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ URL::asset('/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ URL::asset('/css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <!-- <link href="{{ URL::asset('http://fonts.googleapis.com/css?family=Open+Sans') }}" rel='stylesheet' type='text/css' /> -->
</head>
<body>
    <div id="wrapper">
        <!-- 顶栏-logo与登录状态区域 -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url ('index')}}"><img src="{{ URL::asset('/images/logo.png') }}" height="50px" /></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><img src="{{session('adminPic')}}" width="50px" height="50px" /></li>
                        <li class = "adminName">{{session('adminName')}}</li>
                        <li><a href="{{url ('admin/logout')}}">退出登录</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 完成-顶栏-logo与登录状态区域 -->
        <!-- 侧边菜单栏区域  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="{{ URL::asset('/images/find_user.png') }}" class="img-responsive" />
                    </li>
                    <li>
                        <a href="{{url ('admin/index')}}"><i class="fa fa-table "></i>用户管理</a>
                    </li>
                    <li>
                        <a href="{{url ('admin/content')}}"><i class="fa fa-qrcode "></i>文章管理</a>
                    </li>
                    <li>
                        <a href="{{url ('admin/reply')}}"><i class="fa fa-bar-chart-o"></i>回复管理</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit "></i>回收站<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url ('admin/userDel')}}">用户锁定管理</a>
                            </li>
                            <li>
                                <a href="{{url ('admin/contentDel')}}">文章回收站</a>
                            </li>
                            <li>
                                <a href="{{url ('admin/replyDel')}}">回复回收站</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- 完成-侧边菜单栏区域 -->
        <!-- 回复管理区域 -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            回复管理
                        </h2>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                    <form action="{{url ('/admin/replyDel')}}" method = "post">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>
                        <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <th><div style="width:60px;">选择</div></th>
                                    <th>所属文章</th>
                                    <th>回复内容</th>
                                    <th>发表时间</th>
                                </tr>
                                @if (!empty($replys))
                                @foreach ($replys as $vReply)
                                <tr>
                                    <td><input type = "checkbox" name = "id[]" value = "{{$vReply->id}}"/></td>
                                    <td>
                                        @foreach ($contents as $vContent)
                                            @if ($vContent->id == $vReply->tid)
                                                <a href="{{ url('single/' . $vContent->id) }}">{{$vContent->title}}</a>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td><div style="width:550px; max-height: 120px; overflow: hidden; text-overflow: ellipsis;">{{$vReply->content}}</div></td>
                                    <td align="centet">{{ date('Y-m-d H:i:s' , $vReply->addtime)}}</td>
                                </tr>
                               @endforeach
                               @endif
                        </table>
                        <!-- 分页 -->
                        <div class="pagination pagination__posts">
                            {!! $replys->links() !!}
                        </div>
                        <!-- 分页 -->
                            <input type = "submit" value = "回收" class="btn btn-danger btn-lg btn-block" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- 完成-回复管理区域  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ URL::asset('/js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ URL::asset('/js/jquery.metisMenu.js') }}"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="{{ URL::asset('/js/custom.js') }}"></script>
</body>
</html>
