<h2>Register</h2>
<form role="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
	<div class="form-group">
    	<label for="username">Username:</label>
    	<input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
    	<label for="email">Email address:</label>
    	<input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
    	<label for="password">Password:</label>
    	<input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="checkbox">
    	<label><input type="checkbox"> I agree to the <a href="/kwnme/public/page/terms">Terms &amp; Conditions</a></label>
	</div>
	<button type="submit" class="btn btn-default pull-right">Sign Up</button>
</form>
<div class="clear clearfix"></div>