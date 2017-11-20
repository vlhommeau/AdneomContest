<?php

use Utils\FastMysqli;

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}
switch ($_SESSION['step']) {
    default:
    case 1:
        header('Location: inscription_1.php');
        break;
    case 2:
        header('Location: inscription_2.php');
        break;
    case 3:
        break;
}

include 'header.php';

/** Insert the user in the database */
$mail = $_SESSION['mail'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];
$nameAvatar = $_SESSION['nameAvatar'];
$nameAvatar[0] = strtoupper($nameAvatar[0]);

if(isset($_POST['modify'])) {
    header('Location: inscription_1.php');
}

if (isset($_POST['finalize'])) {
    /** si pas de validation par mail du compte */
    $userTemp = FastMysqli::fastQuery("SELECT * FROM temp_signup WHERE mail = '$mail'");
    $user = $userTemp->fetch_assoc();

    if (!empty($user)) {
        $name = $user['name'];
        $mail = $user['mail'];
        $avatar = $user['avatar'];

        $userTemp = FastMysqli::fastQuery("SELECT * FROM users WHERE mail = '$mail'");
        $existingUser = $userTemp->fetch_assoc();

        if (count($existingUser['mail']) === 0) {
            $registered = FastMysqli::fastQuery("INSERT INTO users (mail, name, points, fk_avatar) VALUES ('$mail', '$name', 20, $avatar)");
        } else {
            $registered = FastMysqli::fastQuery("UPDATE users SET name = '$name', fk_avatar = $avatar WHERE mail = '$mail'");
        }

        if ($registered) {
            FastMysqli::fastQuery("DELETE FROM temp_signup WHERE mail = '$mail'");
            $users = FastMysqli::fastQuery("SELECT name, picture FROM users, avatar WHERE fk_avatar = avatar.id");
            $_SESSION['finalized'] = true;
            $_SESSION['step'] = 1;
        } else {
            $error['finalize'] = 'unexpected error';
        }
    } else {
        $error['finalize'] = 'unexpected error';
    }
}
?>

<div class="row back" id="step" data-step="step3">
    <?php if(!$_SESSION['finalized']) { ?>
        <div class="col-sm-6 description">
            <div class="container">
                <form id="step3" method="post" name="step3" action="inscription_3.php">
                    <div class="form-group">
                        </br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="summary">
                                    </br>
                                    <label class="reg-text">Please validate your informations to suscribe: </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="reg-text">You are <?= $username ?></span></br>
                                <span class="reg-text">We can write you to <?= $mail ?></span></br>
                                <span class="reg-text">And you will be represented by <?= $nameAvatar ?>!</span></br>
                            </div>
                        </div><br/>
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
                                            <div class="btn-danger reg-text" style="text-align: center"> <?= $error['finalize'] ?>
                                            </div>
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
    <?php } else { ?>
        <div class="col-sm-6 description">
            <div class="row">
                    <div class="finalized">
                        </br>
                        <label class="reg-text">You are registered! Be ready for the 30th of November...!</label>
                        <span class="reg-text"><i>You can come back at any time to modify your name or your avatar</i></span>
                    </div>
            </div>
            <br/><br/><br/><br/><br/><br/><br/>
            <div class="row">
                <div class="participants">
                    <label class="reg-text">Registered participants: </label><br/>
                    <table>
                        <?php while ($registeredUser = $users->fetch_assoc()) { ?>
                            <tr>
                                <td class="char reg-text">
                                    <img src="Styles\Images\Chars_list\<?= $registeredUser['picture'] ?>" width="100" height="100" alt="">
                                </td>
                                <td class="char reg-text" style="text-align: center">
                                    <label class="reg-text"><?= $registeredUser['name'] ?></label>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-sm-6 avatar"></div>
</div>

