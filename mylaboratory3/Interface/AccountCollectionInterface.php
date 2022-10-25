<?php
namespace Interface;

interface AccountCollectionInterface
{
    public function addAccount(AccountInterface $account): AccountCollectionInterface;

    public function removeAccountByCode(int $code): AccountCollectionInterface;
}