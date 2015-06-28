<ul class="nav nav-pills">
  <li role="presentation"><a href="admin">Admin</a></li>
  <li role="presentation"><a href="admin/pages">Pages</a></li>
  <li role="presentation" class="active"><a href="admin/users">Users</a></li>
  <li role="presentation"><a href="admin/stats">Stats</a></li>
  <li role="presentation"><a href="admin/urls">URL's</a></li>
  <li role="presentation"><a href="admin/spammers">Spammers</a></li>
</ul>
<a class="btn btn-default pull-right" role="button" href="http://kwn.me/admin/adduser" role="button">Add New User</a>
<div class="pull-right"><?php echo $data->links('pager'); ?></div>
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
<?php echo $data->links(); ?>

  </table>
</div>
<a href="user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>
