<form action="login" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    Email:<input type="email" name="email" ><br>
    Password:<input type="password" name="password" ><br>
    <button type="submit">Submit</button>&nbsp;<a href="register">Register</a>
</form>