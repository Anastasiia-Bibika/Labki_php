<?php

namespace Model\Account;

use Interface\AccountCollectionInterface;
use Model\Account;

class Repository
{
    public function createNewFile(string $fileName)
    {
        $file = fopen("./$fileName.txt", 'w+');
        fclose($file);
    }

    public function loadDataFromFile(string $fileName): AccountCollectionInterface
    {
        $lines = file("./$fileName.txt", FILE_SKIP_EMPTY_LINES);
        $dict = new Collection([]);
        foreach ($lines as $line) {
            $lineArr = explode(' ', $line);

            $dict->addAccount(new Account((int)$lineArr[0], $lineArr[1], (int)$lineArr[2], $lineArr[3], $lineArr[4]));
        }
        return $dict;
    }

    public function storeDataToFile(AccountCollectionInterface $accountCollection, string $fileName)
    {
        $dataStr = '';
        for ($i = 0; $i < count($accountCollection->getAccountArr()); $i++) {
            $dataStr .= $accountCollection->getAccountArr()[$i]->getCode() . ' ' .
                $accountCollection->getAccountArr()[$i]->getFullname() . ' ' .
                $accountCollection->getAccountArr()[$i]->getState() . ' ' .
                $accountCollection->getAccountArr()[$i]->getSalary() . ' ' .
                $accountCollection->getAccountArr()[$i]->getChildren() . ' ' .
                $accountCollection->getAccountArr()[$i]->getExperience() . "\n";
        }
        file_put_contents("./$fileName.txt", "$dataStr", FILE_APPEND);
    }
}
