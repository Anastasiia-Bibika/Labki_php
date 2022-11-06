<?php
namespace Model;

use Interface\AccountInterface;
use Model\Account\Collection;

class Account implements AccountInterface
{
    public function __construct(int $code = 0,string $fullname ="none",string $state = "none",int $salary = 0,int $children = 0,string $experience = "none"){
        $this->code = $code;
        $this->fullname = $fullname;
        $this->state = $state;
        $this->salary = $salary;
        $this->children = $children;
        $this->experience = $experience;
    }
    public function filterAccounts($state, $children,array $arr)
    {
        $newArray = array();
        for($i = 0; $i < count($arr); $i++){
            if ($arr[$i]->state == $state and $arr[$i]->children < $children or $arr[$i]->children == $children){
                array_push($newArray,$arr[$i] );
            }
        }
        return $newArray;
    }
    public function setCode(int $code): AccountInterface
    {
        $this->code = $code;
        return $this;
    }
    public function getCode(): int
    {
        return $this->code;
    }
    public function setFullname(string $fullname): AccountInterface
    {
        if ($fullname != "") {
            $this->fullname = $fullname;
        }
        return $this;
    }
    public function getFullname(): string
    {
        return $this->fullname;
    }
    public function setState(string $state): AccountInterface
    {
        if ($state != "") {
            $this->state = $state;
        }
        return $this;
    }
    public function getState(): string
    {
        return $this->state;
    }
    public function setSalary(int $salary): AccountInterface
    {
        $this->salary = $salary;
        return $this;
    }
    public function getSalary(): int
    {
        return $this->salary;
    }
    public function setChildren(int $children): AccountInterface
    {
        $this->children = $children;
        return $this;
    }
    public function getChildren(): int
    {
        return $this->children;
    }
    public function setExperience(string $experience): AccountInterface
    {
        $this->experience = $experience;
        return $this;
    }

    public function getExperience(): string
    {
        return $this->experience;
    }
}