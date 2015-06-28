<ul class="nav nav-pills">
<ul class="nav nav-pills">
  <li role="presentation"><a href="admin">Admin</a></li>
  <li role="presentation"><a href="admin/pages">Pages</a></li>
  <li role="presentation"><a href="admin/users">Users</a></li>
  <li role="presentation"><a href="admin/stats">Stats</a></li>
  <li role="presentation"><a href="admin/urls">URL's</a></li>
  <li role="presentation" class="active"><a href="admin/spammers">Spammers</a></li>
</ul>

<a class="btn btn-default pull-right" role="button" href="http://kwn.me/admin/addspammer" role="button">Add Spammer</a>
<h2>Admin &rarr; Spammers</h2>
<div class="panel panel-default">
	<div class="panel-heading">All Spammers</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Spam URL</th>
					<th>Spam IP Address</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ( $data as $spam ): ?>
		<tr>
			<th scope="row"><?php echo $spam->id ?></th>
			<td><?php echo $spam->url ?></td>
			<td><?php echo $spam->ip ?></td>
		</tr>
	<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<a href="user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>
