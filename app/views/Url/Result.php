<div class="alert alert-success" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Success:</span>
  <?php if ( $data->slug !== NULL ): ?>
  Your Short URL is: <a href="http://kwn.me/<?php echo $data->slug ?>" target="_blank">kwn.me/<?php echo $data->slug ?></a>
  <br />
  Statistics for this Short URL can be found here: <a href="http://kwn.me/stats/<?php echo $data->base ?>">kwn.me/stats/<?php echo $data->base ?></a>
  <?php else: ?>
  Your Short URL is: <a href="http://kwn.me/<?php echo $data->base ?>" target="_blank">kwn.me/<?php echo $data->base ?></a>
  <br />
  Statistics for this Short URL can be found here: <a href="http://kwn.me/stats/<?php echo $data->base ?>">kwn.me/stats/<?php echo $data->base ?></a>
  <?php endif; ?>
</div>