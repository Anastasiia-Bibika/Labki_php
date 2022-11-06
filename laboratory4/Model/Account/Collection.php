<?php
namespace Model\Account;

use Interface\AccountInterface;
use Interface\AccountCollectionInterface;

class Collection implements AccountCollectionInterface
{
    public function __construct($accountArr = [])
    {
        $this->accountArr = $accountArr;
    }

    public function getAccountArr()
    {
        return $this->accountArr;
    }

    public function setAccountArr($accountArr = []): AccountCollectionInterface
    {
        $this->accountArr = $accountArr;
        return $this;
    }

    public function addAccount(AccountInterface $account): AccountCollectionInterface
    {
        $this->accountArr[] = $account;
        return $this;
    }

    public function removeAccountByCode(int $code): AccountCollectionInterface
    {
        for ($i = 0; $i < count($this->accountArr); $i++) {
            if ($this->accountArr[$i]->code == $code) {
                unset($this->accountArr[$i]);
            }
        }
        return $this;
    }
}
