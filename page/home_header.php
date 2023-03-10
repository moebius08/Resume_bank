 <!DOCTYPE html>
 <html>
 <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?=$title?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <?php 
    if (@$type == 1) { 
?>
        <link rel='stylesheet' href="<?=$action->helper->loadcss('resumebuild_content_1.css')?>">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" media="all" /> 
<?php
    }
?>
    <link rel='stylesheet' href="<?=$action->helper->loadcss('home.css')?>">
 </head>
 <body>
