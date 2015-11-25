<form action="register" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    Email:<input type="email"><br>
    Password:<input type="password"><br>
    <button type="submit">Submit</button>&nbsp;<a href="login">Login</a>
</form>