用户中心<br>
{{$_COOKIE['user_name']}},欢迎登陆<br>
<table>
    <tr>
        <td>用户id</td>
        <td>用户名称</td>
        <td>用户邮箱</td>
    </tr>
    @foreach($user as $k=>$v)
    <tr>
        <td>{{$v->user_id}}</td>
        <td>{{$v->user_name}}</td>
        <td>{{$v->email}}</td>
    </tr>
        @endforeach
</table>
