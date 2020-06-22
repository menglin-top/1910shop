
<html>
<body>
<form method="post" action="{{url("user/do_login")}}">
    @csrf
    用户名:<input name="user_name" value="" type="text"><br>
    密码：<input name="password" value="" type="text"><br>
    <input type="submit" value="登陆">
</form>
</body>
</html>
