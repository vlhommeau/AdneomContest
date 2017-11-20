<?php

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}
switch ($_SESSION['step']) {
    default:
    case 1:
        header('Location: inscription_1.php');
        break;
    case 2:
        break;
    case 3:
        header('Location: inscription_3.php');
        break;
}

include 'header.php';
use Utils\FastMysqli;

if (isset($_POST['nextStep'])) {
    if (!empty($_POST['idSelectedChamp'])) {

        /** Check if this avatar is free */
        $idAvatar = FastMysqli::escape($_POST['idSelectedChamp']);
        $nameAvatar = FastMysqli::escape($_POST['nameSelectedChamp']);

        /** This avatar is already saved for someone */
        $resultAvatar = FastMysqli::fastQuery("SELECT id FROM users WHERE fk_avatar = '$idAvatar' AND mail != '" . $_SESSION['mail'] . "'");
        $numberAvatar = $resultAvatar->fetch_assoc();
        if (count($numberAvatar['id']) > 0) {
            $error = 'This avatar is already taken! Nice try...';
        }

        /** This avatar is already reserved for someone */
        $resultAvatar = FastMysqli::fastQuery("SELECT mail FROM temp_signUp WHERE avatar = '$idAvatar' AND mail != '" . $_SESSION['mail'] . "'");
        $numberAvatar = $resultAvatar->fetch_assoc();
        if (count($numberAvatar['mail']) > 0 && $numberAvatar['mail'] != $_SESSION['mail']) {
            $error = 'Someone has just reserved this Avatar, please chose another one ;(';
        }

        /** switch to the third step if no error */
        if (empty($error)) {
            $_SESSION['step'] = 3;
            $_SESSION['avatar'] = $idAvatar;
            $_SESSION['nameAvatar'] = $nameAvatar;

            $resultMail = FastMysqli::fastQuery("SELECT mail FROM temp_signUp WHERE mail = '" . $_SESSION['mail'] . "'");
            $numberMails = $resultMail->fetch_assoc();
            if (count($numberMails['mail']) > 0) {
                $resultName = FastMysqli::fastQuery("UPDATE temp_signUp SET avatar='$idAvatar' WHERE mail = '" . $_SESSION['mail'] . "'");
            } else {
                $_SESSION['error'] = 'An error has occurred, please try again';
                header('Location: inscription_1.php');
            }
            header('Location: inscription_3.php');
        }
    } else {
        $error = 'Pick a champ';
        unset($_POST);
    }
}

/** Get the free avatar list */
$avatarsTakenResult = FastMysqli::fastQuery("SELECT fk_avatar FROM users WHERE mail != '".$_SESSION['mail']."'");
while($avatar = $avatarsTakenResult->fetch_assoc()) {
    $reservedAvatars[] = $avatar['fk_avatar'];
}
$avatarsTakenResult = FastMysqli::fastQuery("SELECT avatar FROM temp_signUp WHERE mail != '".$_SESSION['mail']."'");
while($avatar = $avatarsTakenResult->fetch_assoc()) {
    $reservedAvatars[] = $avatar['avatar'];
}

/** Get all avatar faces path for selection menu */
$resultAvatar = FastMysqli::fastQuery("SELECT * FROM avatar");
$avatarsFaces = [];
while ($avatarFace = $resultAvatar->fetch_assoc()) {
    $name = explode('.', $avatarFace['picture']);
    if (in_array($avatarFace['id'], $reservedAvatars)) {
        $avatarFace['picture'] = $name[0].'_taken.'.$name[1];
        $avatarFace['onClick'] = false;
    } else {
        $avatarFace['onClick'] = 'onclick="setChampion(this.id);"';
    }
    $avatarFace['name'] = $name[0];
    $avatarsFaces[] = $avatarFace;
}

?>
<body>
    <div class="row mainLayoutStep2" id="step" data-step="step2">
        <div class="backg">
            <div class="row">
            </div>
            <div class="botStep2">
                <img class="selectedChar" src="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="charList">
            <form id="step2" method="post" name="step2" action="inscription_2.php">
                <input type="hidden" value="" id="idSelectedChamp" name="idSelectedChamp">
                <input type="hidden" value="" id="nameSelectedChamp" name="nameSelectedChamp">
                <div class="btn-danger" style="text-align: center"> <?= $error ?>
                </div>
                <table>
                    <tr>
                        <?php
                            $tdNumber = 0;
                            foreach ($avatarsFaces as $avatar) {
                                $tdNumber++;
                                ?>
                                <td class="char" name="<?=$avatar['name']?>" id="<?='champ'.$avatar['id']?>" data-animation-path="Styles\Images\Chars_move\<?=$avatar['animation']?>" <?= ($avatar['onClick']) ?>><img src="Styles\Images\Chars_list\<?= $avatar['picture']?>" width="100" height="100" alt=""></td>
                                <?php
                                if ($tdNumber == 11) { ?>
                                    <td></td>
                                    <td colspan="2" rowspan="2">
                                        <div class="svg-wrapper">
                                            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                                <rect id="shape" height="40" width="150"/>
                                                <div id="text">
                                                    <span class="spot">
                                                        <input type="submit" value="Next step" name="nextStep" class="sub">
                                                    </span>
                                                </div>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <?php
                                }
                            }
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>