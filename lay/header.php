<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Главная</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">

    </head><!--/head-->
    <body>
<? if (!isset($_SESSION['user'])):?>
    <div class="col-xs-3">
        <a href="/user/login/">Вход</a>
    </div>
<?else:?>
    <div class="col-xs-3">
        <a href="/user/logout/">Выход</a>
    </div>
<?endif;?>