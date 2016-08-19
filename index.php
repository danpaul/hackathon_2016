<?php
    if($_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER["HTTP_X_FORWARDED_PROTO"] != "https"){
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
?>
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
    
    <div class="wrapper" id="intro">
        <p>WANT TO MAKE A FRIEND?</p>
        <h1>React and be matched to people near you</h1>
        
        <form id="question-form" name="question-form">
            <input type="hidden" name="lat" id="lat" value="" />
            <input type="hidden" name="long" id="long" value="" />
            <input type="submit" name="submit" id="submit" value="READY TO RANDOJI" />
            <div id="form-overlay">Finding something to react to...</div>
        </form>
    </div>
    
    <div class="wrapper" id="question">
        <h1 data-questionid=""></h1>
        <div class="answers">
            <a href="javascript:void(0)" class="answer-0 twa" data-answer="0" data-question-number=""></a>
            <a href="javascript:void(0)" class="answer-1 twa" data-answer="1" data-question-number=""></a>
            <a href="javascript:void(0)" class="answer-2 twa" data-answer="2" data-question-number=""></a>
            <a href="javascript:void(0)" class="answer-3 twa" data-answer="3" data-question-number=""></a>
        </div>
    </div>
    
    <script type='text/javascript' src='js/vendor/jquery.form.js'></script>
    <script type='text/javascript' src='js/vendor/jquery.validate.min.js'></script>
    <script type='text/javascript' src='js/scripts.js?v=<?php echo round(microtime(true) * 1000); ?>'></script>
</body>

</html>