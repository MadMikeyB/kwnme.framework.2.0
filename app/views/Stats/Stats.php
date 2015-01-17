<h2>Statistics &rarr; kwn.me/<?php echo $data['0'] ?></h2>

<ul class="list-group">
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->id ?></span> Unique ID</li>
	<li class="list-group-item"><span class="badge"><?php echo ($data[1]->slug ? '' : $data[1]->base) ?></span> Custom Slug</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->createdon ?></span> Created on</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->lastvisiteddon ?></span> Last visited on</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->clickcount ?></span> Click count</li>
	<li class="list-group-item"><span class="badge"><?php echo $data[1]->url ?></span> Long URL</li>
</ul>