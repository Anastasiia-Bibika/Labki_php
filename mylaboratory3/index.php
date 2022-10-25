<?php
use Model\Account;
use Model\Account\Collection;
use Model\Account\Repository;

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');

$acc1 = new Account( 1,'Dmitriy Yuriovich Prodan',"teacher",18000,18,"3 years");
$acc2 = new Account( 2,'Georgy Ivanovych Kovalenko',"head teacher",20000,21,"5 years");
$acc3 = new Account( 3,'Myroslava Andriivna Kruch',"director",23000,19,"7 years");

$accountCollections = new Collection([$acc1,$acc2,$acc3]);
$saveCarCollection = new Repository();

$saveCarCollection->createNewFile('accounts');
$saveCarCollection->storeDataToFile($accountCollections, 'accounts');
var_dump($accountCollections);
echo "<br>";
echo '<br> After remowing Account by code <br>';

$accountCollections->removeAccountByCode(1);

var_dump($accountCollections);

