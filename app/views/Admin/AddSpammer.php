<ul class="nav nav-pills">
  <li role="presentation"><a href="admin">Admin</a></li>
  <li role="presentation"><a href="admin/pages">Pages</a></li>
  <li role="presentation"><a href="admin/users">Users</a></li>
  <li role="presentation"><a href="admin/stats">Stats</a></li>
  <li role="presentation"><a href="admin/urls">URL's</a></li>
  <li role="presentation" class="active"><a href="admin/spammers">Spammers</a></li>
</ul>
<?php if ( isset( $data[3] ) ): ?>
<br />
<div class="alert alert-success" role="alert">
	<i class="fa fa-bell-o"></i>
	<?php echo $data[3]; ?>
</div>
<?php endif; ?>
<h1>Add Spammer</h1>
<div class="well well-lg">
	<form action="http://kwn.me/admin/addspammer" method="POST" role="form">
		<label for="url">Spam URL</label>
		<input type="text" name="url" class="form-control" value="<?php if (isset($data[0])) { echo $data[0]; } ?>" />

		<label for="ip">Spam IP <small>(Optional)</small></label>
		<input type="text" name="ip" class="form-control" value="<?php if (isset($data[1])) { echo $data[1]; } ?>"  />

		<label for="base">Spam Base <small>(Optional)</small></label>
		<input type="text" name="base" class="form-control" value="<?php if (isset($data[2])) { echo $data[2]; } ?>"  />
		<div align="center">
			<input type="submit" value="Save &rarr;" class="button">
		</div>
	</form>
</div>