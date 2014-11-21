<h2>Admin &rarr; Users</h2>
<div class="panel panel-default">
	<div class="panel-heading">All Users</div>
  <table class="table">
  	<tr>
  		<td><b>#</b></td>
  		<td><b>Username</b></td>
  		<td><b>Email</b></td>
  	</tr>
<?php
foreach ( $data as $u ):
?>
  <tr>
  	<td><?php echo $u->id ?></td>
  	<td><?php echo $u->username ?></td>
  	<td><?php echo $u->email ?></td>
  </tr>
<?php
endforeach;
?>
  </table>
</div>
<a href="user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>
