<?php
namespace Utils;


class NameCheck
{
    const ERROR_FREE = 1;

    protected $name;
    protected $error = [];

    public function __construct($name)
    {
        $this->setName($name);
        $this->controlEverything();
    }

    public function controlEverything()
    {
        $this->isFreeName();
    }

    public function isFreeName()
    {
        $resultName = FastMysqli::fastQuery("SELECT name FROM users WHERE name = '$this->getName()'");
        $numberName = $resultName->fetch_assoc();
        if (count($numberName['name']) > 0) {
            $this->setError($this::ERROR_FREE);
        }
    }

    public function getFirstError()
    {
        return (!empty($this->error)) ? $this->error[0] : null;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return NameCheck
     */
    public function setName($name)
    {
        $username = FastMysqli::escape($name);
        $this->name = $username;
        return $this;
    }

    public function getErrorLabel($errorCode)
    {
        $error = 'Unknown error';
        switch ($errorCode) {
            case $this::ERROR_FREE:
                $error = 'This username is already taken';
                break;
            case null:
                $error = '';
                break;
        }

        return $error;
    }
}
