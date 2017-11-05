<?php

use Utils\FastMysqli;

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 3;
}
switch ($_SESSION['step']) {
    default:
    case 1:
        //header('Location: inscription_1.php');
        break;
    case 2:
        //header('Location: inscription_2.php');
        break;
    case 3:
        break;
}

include 'header.php';

/** Insert the user in the database */
$mail = $_SESSION['mail'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];
/*
if (!FastMysqli::fastQuery("INSERT INTO users ('mail', 'name', 'points', 'fk_avatar') VALUES ('$mail', '$username', 20, $avatar)")) {
    echo 'Error';
}*/

?>

<div class="row" id="step" data-step="step3">
    <div class="col-xs-6 description"><h4 style="color:#959595"><?= "Finalize your inscription" ?> :</h4>
        <div class="container"><span class="data-target-resolver"></span>
            <h1 class="heading " data-target-resolver></h1>
        </div>
    </div>
    <div class="col-xs-6 avatar"></div>
</div>
<div class="col-lg-6 col-xs-12">
    <form id="step3" method="post" name="step3" action="inscription_3.php">
        <div class="infos">
            <p></p>
        </div>
        <div class="form-group">
            </br>
            <div class="row">
                <div class="col-lg-5 col-xs-12">
                    <button class="greenbutton" type="submit">Next step</button>
                </div>
            </div>
        </div>
    </form>
</div>