<!-- footer/ --><div align="center" class="footertxt">
<!--Drag this <a class="bookmarklet"  href="javascript:(function(){ window.open('http://kwn.me/b.php?process=1&url='+escape(location.href)+'&title='+escape(document.title)); })()" title="Share with kwn.me">bookmarklet</a> into your bookmarks toolbar, and click it on any site (other than this one) for easier shortening.<br /><br />kwn.me is not responsible for misuse of the service provided.<br /> -->
    	<a href="http://kwn.me" class="label label-primary" style="color:#FFF !important;">Home</a> | 
    <?php if ( ( $user = Auth::check(@$_COOKIE['user']) ) && ( $user->group_id > '2' ) ): ?> 
    	<a href="http://kwn.me/admin" class="label label-danger" style="color:#FFF !important;">Admin</a> |
    <?php endif; ?>
	<a href="http://kwn.me/page/about" class="label label-success" style="color:#FFF !important;">About</a> | 
	<a href="http://kwn.me/page/terms" class="label label-warning" style="color:#FFF !important;">Terms</a> | 
	<a href="http://kwn.me/page/features" class="label label-default" style="color:#FFF !important;">Features</a> | 
	<a href="http://kwn.me/page/contact" class="label label-default" style="color:#FFF !important;">Contact</a>
  <hr />
     	Copyright &copy; 2009-<?php echo date('Y') ?> kwn.me 
		<br /></div>
	<!-- /box -->
		<br style="clear:both" />

    </article>

  <footer>
    
  </footer>
</body>
</html>
