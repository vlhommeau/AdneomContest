<head>
    <link rel="stylesheet" type="text/css" href="Styles/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/step1.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/test.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/step2.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/button.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Styles/step3.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="Styles/jcarousel.connected-carousel.css" media="screen" />
    <script  type="text/javascript" src="Js/jquery.js"></script>
    <script type="text/javascript" src="Js/jquery.min.js"></script>
    <script type="text/javascript" src="Js/active.gestion.js"></script>
    <script type="text/javascript" src="Js/step2.js"></script>
    <script type="text/javascript" src="Js/jcarousel.connected-carousel.js"></script>
    <script type="text/javascript"  src="Js/jquery.jcarousel.min.js"></script>
    <script  type="text/javascript" src="Js/script.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="Js/step3.js"></script>

</head>

<div ui-view="" class="ng-scope">
    <div class="row ng-scope">
        <div class="col-sm-12">
            <div id="adneom" class="col-lg-2">

            </div>
            <div id="form-container" class="col-lg-24">
                <div class="page-header text-center">
                    <ul id="progressbar">
                        <li id="1" class="active">Username</li>
                        <li id="2">Avatar choice</li>
                        <li id="3">Confirmation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include "Utils/FastMysqli.php";
include "Utils/MailCheck.php";
include "Utils/NameCheck.php";


