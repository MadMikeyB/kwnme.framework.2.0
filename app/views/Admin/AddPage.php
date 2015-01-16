<h1>Add Page</h1>

<script src="//cdn.ckeditor.com/4.4.6/basic/ckeditor.js"></script>

<form action="http://kwn.me/admin/addpage" method="POST" role="form">
	<label for="title">Page Title <small>(slug will be generated from this)</small></label>
	<input type="text" name="title" id="title" class="form-control"  />
	<br />
	<textarea id="ckeditor" name="content" rows="50"></textarea>
	
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