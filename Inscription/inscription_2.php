<?php

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}
switch ($_SESSION['step']) {
    default:
    case 1:
        //header('Location: inscription_1.php');
        break;
    case 2:
        break;
    case 3:
        break;
}

include 'header.php';
use Utils\FastMysqli;

if (isset($_POST['hiddenSelectedChamp'])) {

    /** Check if this avatar is free */
    $idAvatar = FastMysqli::escape($_POST['hiddenSelectedChamp']);

    /** This avatar is already saved for someone */
    $resultAvatar = FastMysqli::fastQuery("SELECT id FROM users WHERE fk_avatar = '$idAvatar'");
    $numberAvatar = $resultAvatar->fetch_assoc();
    if (count($numberAvatar['id']) > 0) {
        $error['avatarTaken'] = 'This avatar is already taken! Nice try...';
    }

    /** This avatar is already reserved for someone */
    $resultAvatar = FastMysqli::fastQuery("SELECT mail FROM temp_signUp WHERE avatar = '$idAvatar'");
    $numberAvatar = $resultAvatar->fetch_assoc();
    if (count($numberAvatar['mail']) > 0 && $numberAvatar['mail'] != $_SESSION['mail']) {
        $error['avatarReserved'] = 'Someone has just reserved this Avatar, please chose another one ;(';
    }

    /** switch to the third step if no error */
    if (empty($error)) {
        $_SESSION['step'] = 3;
        $_SESSION['avatar'] = $idAvatar;

        $resultMail = FastMysqli::fastQuery("SELECT mail FROM temp_signUp WHERE mail = '".$_SESSION['mail']."'");
        $numberMails = $resultMail->fetch_assoc();
        if (count($numberMails['mail']) > 0) {
            $resultName = FastMysqli::fastQuery("UPDATE temp_signUp SET avatar='$idAvatar' WHERE mail = '".$_SESSION['mail']."'");
        } else {
            $_SESSION['error'] = 'An error has occurred, please try again';
            header('Location: inscription_1.php');
        }
        header('Location: inscription_3.php');
    }
}

/** Get the free avatar list */
$avatarsTakenResult = FastMysqli::fastQuery("SELECT fk_avatar FROM users");
while($avatar = $avatarsTakenResult->fetch_assoc()) {
    $reservedAvatars[] = $avatar['fk_avatar'];
}
$avatarsTakenResult = FastMysqli::fastQuery("SELECT avatar FROM temp_signUp");
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
                <input type="hidden" value="" id="hiddenSelectedChamp" name="hiddenSelectedChamp">
                <table>
                    <tr>
                        <?php
                            $tdNumber = 0;
                            foreach ($avatarsFaces as $avatar) {
                                $tdNumber++;
                                ?>
                                <td class="char" name="<?=$avatar['name']?>" id="<?='champ'.$avatar['id']?>" data-animation-path="Styles\Images\Chars_move\<?=$avatar['animation']?>" <?= ($avatar['onClick']) ?>><img src="Styles\Images\Chars_list\<?= $avatar['picture']?>" width="100" height="100" alt=""></td>
                                <?php
                                if ($tdNumber == 11) {
                                    echo '<td></td><td colspan="2" rowspan="2"> <input type="submit" value="" class="validateNextButton" width="96" height="72"></td></tr><tr>';
                                }
                            }
                            echo '</tr>';
                        ?>
                        <div class="btn-danger"> <?= $error['tempLost'] ?></div>
                </table>
            </form>
        </div>
    </div>
</body>