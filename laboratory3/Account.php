<?php

class Account
{
    public $code;
    public $fullname;
    public $state;
    public $salary;
    public $children;
    public $experience;

    public function __construct($code, $array)
    {
        $this->code = $code;
        $this->fullname = $array['fullname'];
        $this->state = $array['state'];
        $this->salary = $array['salary'];
        $this->children = $array['children'];
        $this->experience = $array['experience'];
    }

    public static function validationDataAccounts($array)
    {
        return !(
            empty($array['fullname']) ||
            empty($array['state']) ||
            empty($array['salary']) ||
            empty($array['children']) ||
            empty($array['experience']) ||
            $array['salary'] < 0 ||
            $array['experience'] < 0 ||
            $array['children'] < 0 ||
            !isset($array)
        );
    }
}