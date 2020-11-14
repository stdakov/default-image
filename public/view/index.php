<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="HTML, CSS, image, images, generate image, no image, random image, custom image, need image, tools, tool, web tool, web image tool, html tool">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Easy, no bullshit placeholder images">
    <meta name="author" content="Stanislav Dakov">
    <link rel="icon" href="/media/img/favicon.ico" />

    <title>Lorem Ipsum Image</title>

    <!-- Bootstrap core CSS -->
    <link href="/media/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/media/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="header clearfix">
            <h1>Lorem Ipsum Image</h1>
            <strong>Easy, no bullshit placeholder images...</strong>
            <strong style="float:right">generated images: <?= count(scandir('media/storage')); ?></strong>
        </div>

        <div class="jumbotron">
            <img src="/400x100">

            <h2>Generate Image</h2>

            <form class="form-inline" method="post" action="">
                <div class="form-group">
                    <input type="text" name="width" class="form-control" placeholder="width">
                </div>
                x
                <div class="form-group">
                    <input type="text" name="height" class="form-control" placeholder="height">
                </div>
                </br>
                </br>
                <button type="submit" class="btn btn-success">Generate</button>
            </form>
        </div>
        <div>

            Wiki <strong>[<a target="_blank" href="/media/demo.html">Demo</a>]</strong>: <br />

            1. With url: <br /> <br />
            Example: <strong><?= htmlspecialchars('<img src="http://' . $_SERVER['SERVER_NAME'] . '/300x200" />') ?></strong><br /> <br />
            2. With aliases: <br />
            first include <strong><?= htmlspecialchars('<script src="http://' . $_SERVER['SERVER_NAME'] . '/media/js/replace.js"></script>') ?></strong> in the footer of the page<br /><br />

            Example: <strong><?= htmlspecialchars('<img src="bg300x200" />') ?></strong><br />
            Example: <strong><?= htmlspecialchars('<img src="bg150" />') ?></strong> this will create image 150x150<br /><br />
            if the image is in div with already defined <strong>Width</strong> and <strong>Height</strong> just use: <br />
            Example: <strong><?= htmlspecialchars('<div style="width: 300px; height: 200px;"><img src="bg" /></div>') ?></strong><br />

        </div>
        <br />
        <footer class="footer">
            <p>created by <a href="https://twitter.com/StanislavDakov" target="_blank">@StanislavDakov</a></p>
        </footer>

    </div>
    <!-- /container -->


</body>

</html>