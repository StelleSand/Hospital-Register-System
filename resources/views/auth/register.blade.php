<form action="register" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    Email:<input name="email" type="email"><br>
    Password:<input name="password" type="password"><br>
    <button type="submit">Submit</button>&nbsp;<a href="login">Login</a>
</form>