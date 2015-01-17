<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Welcome back, <?=$data->username?></h3>
  </div>
  <div class="panel-body">
  	<ul class="list-group">
  		<li class="list-group-item"><a href="">Shorten a URL!</a></li>
  		<li class="list-group-item"><a href="stats/home">URL Statistics</a></li>
	<?php if ( $data->group_id >= '2' ): ?>
  		<li class="list-group-item"><a href="admin/users">Admin &rarr; Users</a></li>
  		<li class="list-group-item"><a href="admin/urls">Admin &rarr; URL's</a></li>
	<?php endif; ?>
	</ul>
  </div>
</div>
<a href="/user/logout" class="right">Log out?</a>
<div class="clear clearfix"></div>