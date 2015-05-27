<h2>
<?php
echo $data->title
?>
</h2>

<div class="well well-lg">

<?php
echo $data->content
?>

</div>

<?php
if ( $user = Auth::check( @$_COOKIE['user'] ) && ( $user->group_id === '3' ) )
{
	echo '<a href="/admin/editpage/'.$data->slug.'" class="pull-right label label-default" style="color:#FFFFFF !important;">Edit Page</a>';
}
?>