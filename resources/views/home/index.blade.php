<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <div class="container">
   <div class="row">
      <a href="{{url ('home/register')}}" type="button" class="btn btn-success">注册</a>
   </div>
     <table class="table table-hover">
        <thead>
          <tr>
              <th>编号</th><th>姓名</th> <th>邮箱</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
              <tr>
                <td>{{$user->uid}}</td>
                <td>{{$user->uname}}</td>
                <td>{{$user->class}}</td>
                
              </tr>
          @endforeach
        </tbody>
     </table>
     {!! $users->links() !!}
     
   </div>
 
  </body>
</html>