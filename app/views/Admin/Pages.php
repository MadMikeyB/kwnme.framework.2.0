<a class="btn btn-default pull-right" role="button" href="http://kwn.me/admin/addpage" role="button">Add New Page</a>
<h1>All Pages</h1>
<div class="well well-lg">
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