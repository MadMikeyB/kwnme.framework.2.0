<ul class="nav nav-pills">
  <li role="presentation"><a href="admin">Admin</a></li>
  <li role="presentation" class="active"><a href="admin/pages">Pages</a></li>
  <li role="presentation"><a href="admin/users">Users</a></li>
  <li role="presentation"><a href="admin/stats">Stats</a></li>
  <li role="presentation"><a href="admin/urls">URL's</a></li>
</ul>

<a class="btn btn-default pull-right" role="button" href="http://kwn.me/admin/addpage" role="button">Add New Page</a>
<h2>Admin &rarr; Pages</h2>
<div class="panel panel-default">
	<div class="panel-heading">All Pages</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Page Title</th>
					<th>Page Slug</th>
					<th>Moderation</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ( $data as $page ): ?>
		<tr>
			<th scope="row"><?php echo $page->id ?></th>
			<td><?php echo $page->title ?></td>
			<td><a href="http://kwn.me/page/<?php echo $page->slug ?>"><?php echo $page->slug ?></a></td>
			<td><a href="http://kwn.me/admin/editpage/<?php echo $page->slug ?>">[Edit]</a> / <a href="http://kwn.me/admin/deletepage/<?php echo $page->slug ?>">[Delete]</a> </td>
		</tr>
	<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<a href="user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>
