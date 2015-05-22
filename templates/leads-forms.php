<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>ווידאו</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.2/css/material.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-right: 20px">
            <!--            <div class="header clearfix">
                            <nav>
                                <ul class="nav nav-pills pull-right">
                                    <li role="presentation" class="active"><a href="#">Home</a></li>
                                    <li role="presentation"><a href="#">About</a></li>
                                    <li role="presentation"><a href="#">Contact</a></li>
                                </ul>
                            </nav>
                            <h3 class="text-muted">Project name</h3>
                        </div>-->

            <div class="row">

                <form class="form-horizontal" id="update_form" action="http://api.yaelzals.co.il/leads/<?php echo $this->data['url']; ?>" method="POST">

                    <fieldset>

                        <!-- Form Name -->
                        <legend>אני רוצה לשאול</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-4 col-xs-8">
                                <input id="name" name="name" type="text" placeholder="שם" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-4 col-xs-8">
                                <input id="email" name="email" type="text" placeholder="אימייל" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-4 col-xs-8">
                                <input id="phone" name="phone" type="text" placeholder="מס טלפון" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                            <div class="col-md-4 col-xs-8">                     
                                <textarea class="form-control" id="description" name="description" placeholder="תוכן הפניה "></textarea>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-md-4 col-xs-8">
                                <button id="submit" name="submit" class="btn btn-primary">שליחה</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </body> 
</html>