<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]><html class="lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]><html class="lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 9]><html class="ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="gt-ie9" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Randoji</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/appletouch-114x114.jpg" />
	<link rel="apple-touch-icon" sizes="144x144" href="img/appletouch-144x144.jpg" />
	<link rel="stylesheet" href="twemoji-awesome.css">
	<link rel='stylesheet' href='style.css' type='text/css' media='all' />
	<script type='text/javascript' src='js/lib/jquery.1.9.1.min.js'></script>
</head>

<body>
    
    <div id="wrapper">
        <h1>You're a Loser</h1>
        <p>Make a friend and stop being lame.</p>
        <form id="question-form" name="question-form">
            <input type="hidden" name="lat" id="lat" value="" />
            <input type="hidden" name="long" id="long" value="" />
            <input type="submit" name="submit" id="submit" value="Get me a question!" />
        </form>
    </div>
    
    <script type='text/javascript' src='js/vendor/jquery.form.js'></script>
    <script type='text/javascript' src='js/vendor/jquery.validate.min.js'></script>
    <script type='text/javascript' src='js/scripts.js?v=<?php echo round(microtime(true) * 1000); ?>'></script>
</body>

</html>