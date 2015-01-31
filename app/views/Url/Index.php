<div class="alert alert-success" role="alert">
	<i class="fa fa-bell-o"></i>
	<strong>kwn.me</strong> is back! We're now <a href="https://github.com/MadMikeyB/kwnme.framework.2.0" target="_blank" class="alert-link">open source!</a> Please report any bugs in our <a href="https://github.com/MadMikeyB/kwnme.framework.2.0/issues" target="_blank" class="alert-link">tracker</a>.
</div>

<form role="form" method="post" action="/">
	<p style="float:right">
		<span class="special"></span>
		<label for="url"></label>
		<input type="text" name="url" value="Enter a URL and hit shorten :)" id="url" autocomplete="off" required="" onfocus="value='http://';">
	</p>

	<p class="optional" style="float:right">
		<label for="slug">(optional) Custom Slug</label>
		<input name="slug" value="" id="slug" autocomplete="off" placeholder="(i.e. shorty)" min="2" maxlength="32">
	</p>

	<div class="optional-field">
		<label for="email">Optional</label>
		<input type="email" name="email" id="email" value="" />
	</div>

	<br style="clear:both">
	<p></p>
	<div align="center">
		<input type="submit" name="process" value="Shorten &rarr;" id="process">
	</div>
	<p></p>
</form>

<div align="center" class="idxstats">
	We have shortened <highlight><?php echo KwnStats::countUrls(); ?></highlight> long links, and <highlight><?php echo KwnStats::countUrls(true); ?></highlight> are custom<br>
	Most popular short URL is:  <?php $pop = KwnStats::mostPopularURL(); echo '<a href="http://kwn.me/'.$pop['base'].'+"><i class="fa fa-info-circle"></i></a> <a href="http://kwn.me/'.$pop['base'].'">kwn.me/' . $pop['base'] . '</a> with <a href="http://kwn.me/stats/'.$pop['base'].'">'.$pop['clicks'] . '</a> clicks'; ?><br>
	The latest short URL created is: <?php $latest = KwnStats::latestURL(); echo '<a href="http://kwn.me/'.$latest.'+"><i class="fa fa-info-circle"></i></a> <a href="http://kwn.me/'.$latest.'">kwn.me/'.$latest.'</a>'; ?>
</div>