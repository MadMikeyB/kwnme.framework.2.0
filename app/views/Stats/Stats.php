<h2>Statistics &rarr; <a href="http://kwn.me/<?php echo ($data[1]->slug ? $data[1]->slug : $data[1]->base) ?>">kwn.me/<?php echo ($data[1]->slug ? $data[1]->slug : $data[1]->base) ?></a></h2>

<ul class="list-group">
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->id ?></span> Unique ID</li>
	<li class="list-group-item"><span class="badge"><?php echo ($data[1]->slug ? $data[1]->slug : $data[1]->base) ?></span> Custom Slug</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->createdon ?></span> Created on</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->lastvisiteddon ?></span> Last visited on</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->clickcount ?></span> Click count</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->url ?></span> Long URL</li>
	<?php if ( ( $user = Auth::check(@$_COOKIE['user']) ) && ( $user->group_id > '2' ) ): ?> 
	<li class="list-group-item"><a href="http://kwn.me/admin/addspammer/<?php echo $data[1]->url; ?>/<?php echo $data[1]->userIP; ?>"><span class="badge"><?php echo $data[1]->url ?></span></a> Spam URL?</li>
<?php endif; ?>
</ul>