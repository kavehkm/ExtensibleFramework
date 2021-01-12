<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucwords($title)?></title>
    <style>
        * {
            font-family: "Courier 10 Pitch", serif;
        }
        .main {
            width: 50%;
            margin: 0 auto;
        }
        .header {
        }
        .header a{
            color: #000000;
            text-decoration: none;
        }
        .menu {
            border-top: 1px solid silver;
            border-bottom: 1px solid silver;
        }
        .menu-item {
            padding: 10px;
            display: inline-block;
        }
        .menu-item a{
            color: blue;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .content{
            font-size: 16px;
            color: dimgray;
        }
        .footer {
            border-top: 1px solid silver;
        }
        .comment {
            font-style: italic;
            font-size: 13px;
        }
        .red {
            color: red;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="header">
            <h1><a href="/">.:Extensible Framework:.</a></h1>
            <p class="comment">
                __extensible PHP framework
            </p>
            <div class="menu">
                <div class="menu-item"><a href="/?route=post/list">Home</a></div>
                <div class="menu-item"><a href="/?route=post/list">Posts</a></div>
                <div class="menu-item"><a href="/?route=category/list">Categories</a></div>
                <div class="menu-item"><a href="/?route=author/list">Authors</a></div>
                <div class="menu-item"><a href="/?route=register/signup">Sign up</a></div>
                <div class="menu-item"><a href="/?route=register/signin">Sign in</a></div>
                <div class="menu-item"><a href="/?route=register/signout">Sign out</a></div>
            </div>
        </div>
        <div class="content">
            <?=$output?>
        </div>
        <div class="footer">
            <p class="comment">
                <span class="red">[</span>extensible framework: all right reserved alaki! <?php $d = new DateTime(); echo $d->format('Y') ?>&copy;<span class="red">]</span>
            </p>
        </div>
    </div>
</body>
</html>