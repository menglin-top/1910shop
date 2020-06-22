<html>
    <body>
        <form method="post" action="{{url("user/do_reg")}}">
            @csrf
            用户名:<input name="user_name" value="" type="text"><br>
            邮件：<input name="email" value=""  type="text"><br>
            密码：<input name="password" value="" type="text"><br>
            确认密码:<input name="password" value="" type="text"><br>
            <input type="submit" value="注册">
        </form>
    </body>
</html>
