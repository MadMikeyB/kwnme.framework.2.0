<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>	
<meta charset="utf-8" />
<title>Shorten URL's with kwn.me</title>
<!--<script src="http://code.jquery.com/jquery.min.js"></script>-->
<!--<script src="http://platform.twitter.com/anywhere.js?id=BWymIIpxyR11vwSx9lL8JQ&v=1" type="text/javascript"></script>-->
<link rel="stylesheet" href="http://kwn.me/css/kwn.me.css" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/kwnme/public/favicon.ico" rel="icon" type="image/x-icon" />
<base href="http://localhost/kwnme/public/" /> <?php // Config::$url ?>
<meta name="generator" content="http://switchtohtml5.com">
</head>
<body>

<!-- Read the footer, we're not responsible or liable for the URLs made on the site, or what they are used for, HOWEVER, we will look into any abuse reports you have. Abuse: info@kwn.me -->
<div class="kwnloginbox">
<span id="login"></span>
<script type="text/javascript">

  twttr.anywhere(function (T) {
    T("#login").connectButton();
  });

</script>
<br />
<?php if ( $user = Auth::check( @$_COOKIE['user'] ) ): ?>
		<div class="kwnlogin">[Welcome back, <a href="user"><?php echo $user->username ?></a>!]</div><br />
<?php else: ?>
		<div class="kwnlogin"><a href="user">[Login]</a>, or <a href="user/create">[Register]</a></div><br />
<?php endif; ?>

</div>

	<article class="box">

