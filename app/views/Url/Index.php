<form role="form" method="post" action="/kwnme/public/url">
	<p style="float:right"><span class="special"></span><label for="url"></label><input type="text" name="url" value="Enter a URL and hit shorten :)" id="url" autocomplete="off" required="" onfocus="value='http://';"></p>
	<p class="optional" style="float:right"><label for="slug">(optional) Custom Slug</label><input name="slug" value="" id="slug" autocomplete="off" placeholder="(i.e. shorty)" min="2" maxlength="32"></p>
	<br style="clear:both">
	<p></p><div align="center"><input type="submit" name="process" value="Shorten →" id="process"></div><p></p>
</form>

<?=$data?>