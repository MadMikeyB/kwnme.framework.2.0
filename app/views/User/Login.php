<h2>Log In</h2>
<form role="form" action="/kwnme/public/user/login" method="POST">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="checkbox">
    <label><input type="checkbox" id="rememberme" name="rememberme"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default pull-right">Submit</button>
</form>
<div class="clear clearfix"></div>