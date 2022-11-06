<?php
use Model\Account;
use Model\Account\Collection;
use Model\Account\Repository;

$dbh = new PDO('mysql:host=127.0.0.1;dbname=account_db', 'root', '');
$sql = "SELECT * FROM accounts;";
function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}
// заповнення бази даних
//function insertInDb($accountCollections,$dbh){
//    foreach ($accountCollections->getAccountArr() as $account) {
//        $sql = 'INSERT INTO accounts(fullname,state,salary,children,experience) VALUES (?,?,?,?,?)';
//        $statement = $dbh->prepare($sql);
//        $statement->execute([
//            $account->getFullname(),
//            $account->getState(),
//            $account->getSalary(),
//            $account->getChildren(),
//            $account->getExperience()
//        ]);
//    }
//}

spl_autoload_register('myAutoloader');

$acc1 = new Account( 1,'Dmitriy Yuriovich Prodan',"teacher",18000,18,"3 years");
$acc2 = new Account( 2,'Georgy Ivanovych Kovalenko',"head teacher",20000,21,"5 years");
$acc3 = new Account( 3,'Myroslava Andriivna Kruch',"director",23000,19,"7 years");

$accountCollections = new Collection([$acc1,$acc2,$acc3]);
$saveAccountCollection = new Repository($dbh);
var_dump($accountCollections);
echo "<br>";
echo '<br> After remowing Account by code <br>';

//$saveAccountCollection->addAccount(
//    $acc1->getFullname(),
//    $acc1->getState(),
//    $acc1->getSalary(),
//    $acc1->getChildren(),
//    $acc1->getExperience(),
//);

//$saveAccountCollection->deleteAccount(2);
var_dump($saveAccountCollection->readAccounts());
$accountCollections->removeAccountByCode(1);

var_dump($accountCollections);

