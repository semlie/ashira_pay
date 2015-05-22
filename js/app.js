'use strict';

var myApp = angular.module('regform', [
    'myApp.directives',
    'myApp.controllers',
    'ngRoute',
    'ui.bootstrap',
    'ngResource'
]);

var PayAdress = "http://localhost/www/ashiraPaymant/index.php/pay";
var RegAdress = "http://localhost/www/ashiraPaymant/index.php/pay";
var crmAdress = "http://localhost/www/ashiraPaymant/index.php/pay";
/* Controllers */

angular.module('myApp.controllers', [])
        .factory('REST', ['$resource', function($resource) {
                return $resource('http://localhost/www/ashiraPaymant/index.php/pay'

                        );
            }])
        .controller('formCtrl', ['$scope', '$http', 'REST', function($scope, $http, REST) {

                $scope.currentPage = 1
                        , $scope.numPerPage = 1
                        , $scope.totel = 120
                        , $scope.maxSize = 12;
                var data = {"noOffPaymant": "0", "card_number": "458007000408865", "card_expire_month": "02", "card_expire_year": "16", "card_owner": "שמואל", "phone": "0527146368", "mail": "israellieb@gmail.com", "maslul": "sub30", "maslulSum": "3", "pname": "שמואל", "address": "הרצוג", "city": "בני ברק", "country": "ישראל", "fu": "update"};

                REST.save(data, function(d) {
                    console.log(d);
                    if (d.Error) {
                        alert(d.Error);
                    }
                    if (d.Url) {
                        alert(d.Url);
                    }

                });
                $scope.mslulim = [/*{'btn': 'btn-info', 'code': 'sub10', 'name': 'הרשם, צפה ושלם בהמשך'},*/
                    {'btn': 'btn-danger', 'code': 'sub30', 'name': 'רק ימימה 30 ש"ח'},
                    {'btn': 'btn-success', 'code': 'sub34', 'name': 'רק ימימה-משפחתי 40 ש"ח'},
                    /*	{'btn': 'btn-primary', 'code': 'sub40', 'name': 'צפיה אישית חופשית בכל האתרים 40 ש"ח'},
                     {'btn': 'btn-primary', 'code': 'sub44', 'name': 'צפיה משפחתית חופשית בכל האתרים 50 ש"ח'},
                     {'btn': 'btn-success', 'code': 'sub50', 'name': 'תרגום+כל האתרים אישי30$ 105 ש"ח'},
                     {'btn': 'btn-success', 'code': 'sub54', 'name': 'תרגום+כל האתרים משפחתי 35$ 120 ש"ח'}*/

                ];
                $scope.user = {};
                $scope.cardlangth = function() {
                    var str = $scope.user.card_number;
                    if (str)
                        return str.length;
                    else
                        return 0;
                };
                $scope.msgs = [];
                $scope.endTran = false;
                var updateScopeFromCrm = function(data) {
                    var b = new Date();
                    if (data['status'] !== 'fail') {
                        data = data['data'];
                        console.log(data);
                        $scope.user.crmId = data['id'] ? data['id'] : '';
                        $scope.user.pname = data['lastName'] ? data['lastName'] : '';

                        $scope.user.address = data['address'] ? data['address'] : '';
                        $scope.user.city = data['city'] ? data['city'] : '';
                        $scope.user.country = data['country'] ? data['country'] : '';

                        $scope.user.phone = data['phone'] ? data['phone'] : '';
                        if (data['sub']) {
                            var sub = JSON.parse(data['sub']);
                            $scope.user.sub = {
                                'sub10': sub['sub10'] ? sub['sub10'] : '',
                                'sub30': sub['sub30'] ? sub['sub30'] : '',
                                'sub34': sub['sub34'] ? sub['sub34'] : '',
                                'sub40': sub['sub40'] ? sub['sub40'] : '',
                                'sub44': sub['sub44'] ? sub['sub44'] : '',
                                'sub50': sub['sub50'] ? sub['sub50'] : '',
                                'sub54': sub['sub54'] ? sub['sub54'] : ''
                            };
                        } else {
                            $scope.user.sub = {
                                'sub10': null,
                                'sub30': null,
                                'sub34': null,
                                'sub40': null,
                                'sub44': null,
                                'sub54': null,
                                'sub50': null
                            };
                        }

                    } else {
                        $scope.user.sub = {
                            'sub10': null,
                            'sub30': null,
                            'sub34': null,
                            'sub40': null,
                            'sub44': null,
                            'sub54': null,
                            'sub50': null
                        };
                    }

                    if ($scope.user.sub[$scope.user.maslul]) {
                        console.log($scope.user.sub[$scope.user.maslul]);
                        var d = new Date($scope.user.sub[$scope.user.maslul]);
                    } else {
                        var d = new Date();
                    }
                    //if renew the subcribe aftar will
                    if (b > d) {
                        d = b;
                    }
                    ;
                    //set the new Date expierd
                    d.setMonth(d.getMonth() + parseInt($scope.user.maslulSum));
                    $scope.user.sub[$scope.user.maslul] = d.toUTCString();
                    console.log($scope.user);
                };
                $scope.$watch(function() {
                    return $scope.user.maslul;

                }, function(newValue, oldValue) {
                    culcPayment();
                });
                $scope.$watch(function() {
                    return $scope.user.maslulSum;

                }, function(newValue, oldValue) {
                    culcPayment();
                });
                var culcPayment = function() {
                    if ($scope.user.maslul == "sub30")
                        $scope.calc = 30 * $scope.user.maslulSum;

                    if ($scope.user.maslul == "sub34")
                        $scope.calc = 40 * $scope.user.maslulSum;
                    console.log($scope.calc);
                };
                var getOldDataCrm = function() {
                    console.log("--> Submitting getOldDataCrm");
                    $scope.user.fu = 'get';
                REST.save($scope.user, function(d) {
                    console.log(d);
                    if (d.Error) {
                        alert(d.Error);
                    }
                    if (d.Url) {
                        alert(d.Url);
                    }

                });


                };
                $scope.step = "step1";
                $scope.user.sendTransaction = function() {
                    console.log($scope.user, "--> Submitting form step1");
                    $scope.wait = true;

                    var PayReg = $http({
                        url: RegAdress,
                        method: "POST",
                        data: $scope.user
                    }).success(function(data, status, headers, config) {
                        console.log(data);
                        var _k = "ההרשמה נכשלה צרו קשר עם צוות המשרד ";
                        var _v = "ההרשמה הסתימה בהצלחה";
//                for (var prop in data[0]) {
//                    if (data[0].hasOwnProperty(prop))
//                        _k = prop; // key name
//						console.log(_k);
//
//                    _v = data[0][prop];
//						console.log(_v);
//                }
                        if (data.indexOf('Success') != -1) {


                            console.log(data);
                            //  $scope.msgs.push(_v);
                            $scope.endTran = true;
                            window.scrollTo(0, 0);
                        }
                        else {
                            //    window.alert(_k);
                            //  $scope.msgs.push(_k);
                            console.log(data);
                            $scope.wait = false;
                            window.scrollTo(0, 0);
                        }
                        //console.log(data);
                        //$scope.msgs.push("ההרשמה הסתימה בהצלחה");
                        //$scope.endTran=true;

                    }).error(function(data, status, headers, config) {
                        console.log(data);
                        //alert(_k);
                    });
                };


            }]);



/* Directives */


angular.module('myApp.directives', []).
        directive('mainMenu', function() {
            return {
                restrict: 'E',
                templateUrl: 'partial/menu.html'
            };
        }).
        directive('carousel', function() {
            return {
                restrict: 'E',
                templateUrl: 'partial/Carousel.html'
            };
        }).
        directive('formReg', function() {
            return {
                restrict: 'E',
                templateUrl: 'partial/form.html'
            };
        }).
        directive('inputs', function() {
            return {
                restrict: 'E',
                templateUrl: 'partial/input-loop.html'
            };
        });