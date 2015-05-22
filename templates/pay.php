<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>תשלום</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.2/css/material.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="/www/ashiraPaymant/css/app.css">

        <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.15/angular.js" ></script> 
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.15/angular-resource.js" ></script> 
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.js" ></script> 
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js" ></script> 

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <script src="/www/ashiraPaymant/js/app.js" ></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body ng-app="regform">
        <div class="container" >

            <!-- Fixed navbar -->
            <nav class="navbar  navbar-fixed-top navbar-material-light-blue-300">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">תרומה לאשירה שמים</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href=http://ashira.co.il"> לאתר אשירה</a></li>
                            <li><a href=http://shamayim.info/">לאתר שמים</a></li>

                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
        </div>            
        <div class="container" >
            <div class="row" >
                <div class="aform" ng-controller="formCtrl">
                    
                    <div class="col-md-12 shadow-z-4" style="
    padding-top: 70px;
">
                        <p class="bg-info"> <a href="https://www.shammaim.info/trumot/trumot.php"> אם עוד לא סיימת לשלם עבור צפיה בשיעורים בשנה החולפת, נא לחצי כאן על מנת לעבור לדף התשלומים הישן כדי לסגור את החוב 
                                ורק לאחר מכן רכשי מנוי לחודשים הבאים.</a>
                        </p>

                        </p>
                        <p class="bg-danger" ng-repeat="msg in msgs track by $index">{{msg}}</p>
                        <form role="form" id="myForm" name="iForm" ng-hide="endTran">
                            <div class="form-group misg" >
                                <a href="//www.shammaim.info/reg/paypal.html">
                                    <img src="//www.shammaim.info/reg/img/paypal_hebrew.png" />
                                </a>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group misg shadow-z-4" >
                                    <label for="exampleInputEmail1">סוג מנוי </label>
                                    <div class="row">
                                        <div style="margin: 30px">
                                            <div class="btn-group-vertical">
                                                <label ng-repeat="i in mslulim" class="btn btn-lg" ng-class="i.btn" ng-model="user.maslul" btn-radio="'{{i.code}}'">{{i.name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="exampleInputEmail1">תקופת מנוי </label>
                                    <div class="row">
                                        <div style="margin: 30px">

                                            <label class="btn btn-primary btn-lg" ng-model="user.maslulSum" btn-radio="'3'">מנוי שלושה חודשים</label>
                                            <label class="btn btn-primary btn-lg" ng-model="user.maslulSum" btn-radio="'6'">מנוי חצי שנה</label>
                                            <label class="btn btn-primary btn-lg" ng-model="user.maslulSum" btn-radio="'12'">מנוי שנתי</label>
<!--                                            <pagination 
                                                ng-model="currentPage"
                                                total-items="totel"
                                                max-size="maxSize"  
                                                direction-links="false"  >
                                            </pagination>-->
                                        </div>

                                    </div>
                                    <label for="exampleInputEmail1">בתשלומים</label>
                                    <div class="row">
                                        <div style="margin: 30px">


                                            <label class="btn btn-primary btn-md" ng-model="user.noOffPaymant" btn-radio="'1'">בתשלום אחד</label>
                                            <label class="btn btn-danger btn-md" ng-model="user.noOffPaymant" btn-radio="'0'">בתשלום חודשי</label>
                                            <div class="col-md-4" ng-show="calc"> <h3>סך הכל:{{calc}}</h3></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group misg shadow-z-4" >
                                    <label for="exampleInputEmail1">אמצעי תשלום</label>
                                    <input type="text" name="card_number" ng-minlength="8" ng-maxlength="16" class="form-control" required id="card_number" placeholder="מספר כרטיס אשראי" ng-model="user.card_number" >
                                    <span class="error" ng-show="iForm.card_number.$invalid && iForm.card_number.$dirty">נא הזינו מספר כרטיס אשראי חוקי משמאל לימין!</span><br>
                                    <span class="error" ng-show="cardlangth() != 8 && cardlangth() != 16">לא תקין</span>
                                    <div>    
                                        <div class="col-md-4">      
                                            <label for="exampleInputEmail1">תוקף</label>
                                        </div>
                                        <div class="col-md-4">        
                                            <select class="form-control" required name="card_expire_month" id="card_expire_month" ng-model="user.card_expire_month">
                                                <option value="01">(01) ינואר</option>
                                                <option value="02">(02) פברואר</option>
                                                <option value="03">(03) מרץ</option>
                                                <option value="04">(04) אפריל</option>
                                                <option value="05">(05) מאי</option>
                                                <option value="06">(06) יוני</option>
                                                <option value="07">(07) יולי</option>
                                                <option value="08">(08) אוגוסט</option>
                                                <option value="09">(09) ספטמבר</option>
                                                <option value="10">(10) אוקטובר</option>
                                                <option value="11">(11) נובמבר</option>
                                                <option value="12">(12) דצמבר</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">    
                                            <select class="form-control" required name="card_expire_year" id="card_expire_year" ng-model="user.card_expire_year">
                                                <option value="14">2014</option>
                                                <option value="15">2015</option>
                                                <option value="16">2016</option>
                                                <option value="17">2017</option>
                                                <option value="18">2018</option>
                                                <option value="19">2019</option>
                                                <option value="20">2020</option>
                                            </select>
                                        </div >
                                    </div> 
                                    <span class="error" ng-show="(iForm.card_expire_month.$invalid || iForm.card_expire_year.$invalid) && iForm.card_expire_month.$dirty">שדה חובה !</span><br>

                                    <input type="text" name="card_owner" required class="form-control" id="card_owner" placeholder="שם בעל הכרטיס" ng-model="user.card_owner" ng-minlength="4">
                                    <span class="error" ng-show=" iForm.card_owner.$invalid && iForm.card_owner.$dirty">שדה חובה - כפי שמופיע על הכרטיס!</span><br>

                                    <input type="number" name="user_phone" required class="form-control" id="user-phone" placeholder="טלפון" ng-model="user.phone" ng-minlength="8" >
                                    <span class="error" ng-show=" iForm.user_phone.$invalid && iForm.user_phone.$dirty">שדה חובה מספרים בלבד!</span><br>

                                    <input type="email" name="user_email" required class="form-control" id="user-email" placeholder="כתובת מייל" ng-pattern='/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' ng-model="user.mail">
                                    <span class="error" ng-show=" iForm.user_email.$invalid && iForm.user_email.$dirty">נא הקישו כתובת מייל חוקית !</span><br>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group misg shadow-z-4" >
                                    <label for="exampleInputEmail1">פרטים אישיים</label>
                                    <input type="text" name="user-pname" class="form-control" id="user-pname" placeholder="שם מלא" ng-model="user.pname">
                                    <input type="text" name="user-address" class="form-control" id="user-address" placeholder="כתובת" ng-model="user.address">
                                    <input type="text" name="user-address" class="form-control" id="user-city" placeholder="עיר" ng-model="user.city">
                                    <input type="text" name="user-address" class="form-control" id="user-country" placeholder="ארץ" ng-model="user.country">
                                    <input type="text" name="user-phone" class="form-control" id="user-phone" placeholder="טלפון" ng-model="user.phone">
                                </div>
                            </div>

                            <div class="loading" ng-show="wait2"></div>

                            <button type="submit" class="btn btn-default btn-lg btn-raised"  ng-disabled="wait2" ng-click="user.submitTheForm()">שליחה</button>
                        </form>
                    </div>
                    <div class="row" ng-show="endTran">
                        <h1>הרישום הסתיים בהצלחה
                        </h1>
                        <h2>
                            <a href="http://ashira.co.il/" >לחצי כאן לחזרה לאתר אשירה</a>
                        </h2>
                    </div>
                </div>


            </div>
            <div class="row">
                שמים אשירה מאמי
            </div>
        </div>


    </div>
</body> 
</html>