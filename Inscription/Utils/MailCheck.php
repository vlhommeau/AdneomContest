<?php
namespace Utils;


class MailCheck
{
    const NO_ERROR = 0;
    const ERROR_FREE = 1;
    const ERROR_AVAILABLE = 2;
    const ERROR_ADNEOM = 3;

    protected $mail;
    protected $error = [];

    public function __construct($mail)
    {
        $this->setMail($mail);
        $this->controlEverything();
    }

    public function controlEverything()
    {
        $this->isFreeMail();
        $this->isAvailableMail();
        $this->isAdneomMail();
    }

    public function isFreeMail()
    {
        $resultMail = FastMysqli::fastQuery("SELECT mail FROM users WHERE mail = '$this->getMail()'");
        $numberMails = $resultMail->fetch_assoc();
        if (count($numberMails['mail']) > 0) {
            $this->setError($this::ERROR_FREE);
        }
    }

    public function isAvailableMail()
    {
        if (!filter_var($this->getMail(), FILTER_VALIDATE_EMAIL)) {
            $this->setError($this::ERROR_AVAILABLE);
        }
    }

    public function isAdneomMail()
    {
        $mailArray = explode('@', $this->getMail());
        $endMail= explode('.', $mailArray[1]);

        if($endMail[0] != 'adneom') {
            $this->setError($this::ERROR_ADNEOM);
        }
    }

    public function getFirstError()
    {
        return (!empty($this->error)) ? $this->error[0] : 0;
    }

    public function getFirstErrorLabel()
    {
        return $this->getErrorLabel($this->getFirstError());
    }

    public function setError($errorCode)
    {
        $this->error[] = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     * @return MailCheck
     */
    protected function setMail($mail)
    {
        $mail = FastMysqli::escape($mail);
        $this->mail = $mail;
        return $this;
    }

    public function getErrorLabel($errorCode)
    {
        $error = 'Unknown error';
        switch ($errorCode) {
            case $this::ERROR_FREE:
                $error = 'This email address is already registered';
                break;
            case $this::ERROR_AVAILABLE:
                $error = 'This email address is not available';
                break;
            case $this::ERROR_ADNEOM:
                $error = 'This email address does not come from Adneom';
                break;
            case $this::NO_ERROR:
                $error = '';
                break;
        }

        return $error;
    }
}
