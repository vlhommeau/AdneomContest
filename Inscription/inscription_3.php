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
 
if (isset($_POST['modify']) || isset($_POST['finalize'])) {
    if (isset($_POST['modify'])) {
        header('Location: inscription_1.php');
    }

    if (isset($_POST['finalize'])) {
        /** si pas de validation par mail du compte
        $userTemp = FastMysqli::fastQuery("SELECT * FROM temp_signUp WHERE mail = '$mail'");
        $user = $userTemp->fetch_assoc();
        $name = $user['name'];
        $mail = $user['mail'];
        $avatar = $user['avatar'];
        if (!FastMysqli::fastQuery("INSERT INTO users ('mail', 'name', 'points', 'fk_avatar') VALUES ('$mail', '$name', 20, $avatar)")) {
            echo 'Error';
        }*/
    }
}


?>

<div class="row" id="step" data-step="step3">
    <div class="col-xs-6 description"><h4 style="color:#959595"><?= "Finalize your inscription" ?> :</h4>
        <div class="container">
            <form id="step3" method="post" name="step3" action="inscription_3.php">
                <div class="infos">
                    <p></p>
                </div>
                <div class="form-group">
                    </br>
                    <div class="row-sm-5">
                        <div class="col-sm-12">
                            <div class="text-container3">
                                </br>
                                <label class="reg-text">Please validate your informations to suscribe: </label>
                            </div>
                        </div>
                    </div>
                    <div class="row-sm-5">
                        <div class="col-sm-12">
                            <span class="reg-text">You are <?= $username ?></span></br>
                            <span class="reg-text">We can write you to <?= $mail ?></span></br>
                            <span class="reg-text">And you will be represented by <?= $avatar ?>!</span></br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="svg-wrapper reg-text">
                                <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                    <rect id="shape" height="40" width="150" />
                                    <div id="text reg-text">
                                        <span class="reg-text spot"><input type="submit" name="modify" value="Modify" class="reg-text sub"></span>
                                    </div>
                                </svg>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="svg-wrapper reg-text">
                                <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                    <rect id="shape" height="40" width="150" />
                                    <div id="text reg-text">
                                        <span class="reg-text spot"><input type="submit" name="finalize" value="Finalize" class="reg-text sub"></span>
                                    </div>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-6 avatar"></div>
</div>
