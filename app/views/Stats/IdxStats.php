<h2>Top Statistics &rarr; kwn.me</h2>
<div class="panel panel-default">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Short URL</th>
				<th>Long URL</th>
				<th>Clicks</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $data as $d ): ?>
			<tr>
				<td>kwn.me/<?php echo $d->base ? $d->base : $d->slug; ?></td>
				<td><a href="http://kwn.me/<?php echo $d->base ? $d->base : $d->slug; ?>"><?php if (strlen($d->url) > 45) { echo substr($d->url, 0, 45)."&#133;"; } else { echo $d->url; } ?></a></td>
				<td><span class="badge"><?php echo $d->clickcount ?></span></td>
				<td><a href="http://kwn.me/stats/<?php echo $d->base ? $d->base : $d->slug; ?>"><span class="label label-info">Stats</span></a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>