<!doctype html>
<html>
  <head>
    <title>User Login</title>
  </head>
  <body>
    <ul id="messages"></ul>
    <form id="form1" action="{{ url('/loginReceiver') }}" method="post">
      <label for="username">Username</label>
      <input id="username" name="username" autocomplete="off" placeholder="The username" />
      <label for="password">Password</label>
      <input id="password" name="password" autocomplete="off" placeholder="The password" />
      <button>Login</button>
    </form>
  </body>
</html>