<h1>Edit Page: <?php echo $data->title ?></h1>

<script src="//cdn.ckeditor.com/4.4.6/basic/ckeditor.js"></script>

<form action="http://kwn.me/admin/editpage/about" method="POST">
	<textarea id="ckeditor" name="content" rows="50"><?php echo $data->content ?></textarea>
	
	<div align="center">
		<input type="submit" value="Save &rarr;" class="button">
	</div>
</form>

<script>
CKEDITOR.replace( 'ckeditor' );
    CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
     config.height = '80vh';

};
</script>