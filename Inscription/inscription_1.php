<?php

use Utils\FastMysqli;
use Utils\MailCheck;
use Utils\NameCheck;

include 'header.php';

if (isset($_POST['mail']) && isset($_POST['username'])) {

    $mailCheck = new MailCheck($_POST['mail']);
    $nameCheck = new NameCheck($_POST['username']);

    $error['mail'] = $mailCheck->getFirstErrorLabel();
    $error['username'] = $nameCheck->getFirstErrorLabel();

    /** switch to the second step if no error */
    if (empty($error['mail']) && empty($error['username'])) {
        $_SESSION['step'] = 2;
        $_SESSION['mail'] = $mailCheck->getMail();
        $_SESSION['username'] = $nameCheck->getName();

        $resultMail = FastMysqli::fastQuery("SELECT mail FROM temp_signUp WHERE mail = '".$mailCheck->getMail()."'");
        $numberMails = $resultMail->fetch_assoc();
        if (count($numberMails['mail']) > 0) {
            $resultName = FastMysqli::fastQuery("UPDATE temp_signUp SET name='".$nameCheck->getName()."' WHERE mail='".$mailCheck->getMail()."'");
        } else {
            $resultName = FastMysqli::fastQuery("INSERT temp_signUp (mail, name) VALUES ('".$mailCheck->getMail()."', '".$nameCheck->getName()."')");
        }
        header('Location: inscription_2.php');
    }
}
?>
<body>
    <div class="col-lg-24 col-xs-12 mainLayout" id="step" data-step="step1">
        <div class="row" xmlns="http://www.w3.org/1999/html">
            <div class="col-xs-12">
                <div class="text-container">
                    </br>
                    <span class="reg-text">Please complete the subscription for the</span>
                    <span class="letter">A</span>
                    <span class="letter">d</span>
                    <span class="letter">n</span>
                    <span class="letter">e</span>
                    <span class="letter">o</span>
                    <span class="letter">m</span>
                    <span class="letter"> </span>
                    <span class="letter">C</span>
                    <span class="letter">o</span>
                    <span class="letter">n</span>
                    <span class="letter">t</span>
                    <span class="letter">e</span>
                    <span class="letter">s</span>
                    <span class="letter">t</span>
                    <span class="letter">!</span>
                </div>
            </div>
        </div>
        </br></br>
        <div class="col-lg-12 col-xs-12">
            <form id="step1" method="post" name="step1" action="inscription_1.php">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-5 col-xs-12">
                            <span class="reg-text">Mail (Adneom email only)</span>
                            <div class="btn-danger reg-text"> <?= $error['mail'] ?>
                            </div>
                            <input type="text" class="form-control reg-text" name="mail" id="mail" value="<?=$_POST['mail']?>" required/>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-lg-5 col-xs-12">
                            <span class="reg-text">Username</span>
                            <div class="btn-danger reg-text"> <?= $error['username'] ?>
                            </div>
                            <input type="text" class="form-control reg-text" name="username" id="username" value="<?=$_POST['username']?>" required/>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-lg-5 col-xs-12">
                            <div class="svg-wrapper reg-text">
                                <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                    <rect id="shape" height="40" width="150" />
                                    <div id="text reg-text">
                                        <span class="reg-text spot"><input type="submit" value="Next step" class="reg-text sub"></span>
                                    </div>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="row bot">

                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
