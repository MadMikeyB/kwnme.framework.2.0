<ul class="nav nav-pills">
  <li role="presentation"><a href="admin">Admin</a></li>
  <li role="presentation"><a href="admin/pages">Pages</a></li>
  <li role="presentation"><a href="admin/users">Users</a></li>
  <li role="presentation"><a href="admin/stats">Stats</a></li>
  <li role="presentation" class="active"><a href="admin/urls">URL's</a></li>
</ul>

<div class="pull-right"><?php echo $data->links('pager'); ?></div>
<h2>Admin &rarr; URL's</h2>
<div class="panel panel-default">
	<div class="panel-heading">All Users</div>
  <table class="table">
  	<tr>
  		<td><b>#</b></td>
  		<td><b>URL</b></td>
      <td><b>Base</b></td>
      <td><b>Slug</b></td>
      <td><b>IP Address</b></td>
      <td><b>Created</b></td>
  	</tr>
<?php
foreach ( $data as $u ):
?>
  <tr>
  	<td><?php echo $u->id ?></td>
  	<td><?php echo $u->url ?></td>
    <td><?php echo $u->base ?></td>
    <td><?php echo $u->slug ?></td>
    <td><?php echo $u->userIP ?></td>
    <td><?php echo $u->datecreated ?></td>
  </tr>
<?php
endforeach;
?>
  </table>
</div>


<a href="user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>
