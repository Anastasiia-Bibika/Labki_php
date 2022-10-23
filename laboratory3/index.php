<?php

include "Account.php";
include "AccountsCollection.php";

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Accounts'])) {
    $_SESSION['Accounts'] = new AccountsCollection();
    $_SESSION['Accounts']->defaultAccounts();
}

$action = $_POST['action'];

if ($action == 'add') {
    if (Account::validationDataAccounts($_POST)) {
        $_SESSION['Accounts']->addAccount(
            new Account(5, $_POST)
        );
    }
} elseif ($action == 'edit') {
    if (Account::validationDataAccounts($_POST)) {
        $_SESSION['Accounts']->editAccount(
            $_POST
        );
    }
} elseif ($action == 'filter') {
    echo $_SESSION['Accounts']->displayFilteredAccounts($_POST['z-state'], $_POST['z-children']);
} elseif ($action == 'savefile') {
    $_SESSION['Accounts']->saveAccounts();
} elseif ($action == 'loadfile') {
    $_SESSION['Accounts']->loadAccounts();
}

echo $_SESSION['Accounts']->displayAccounts();
?>
<br>

<button onclick="ShowAddForm()"> ADD</button>
<button onclick="ShowEditForm()"> EDIT</button>
<button onclick="ShowFilterForm()"> FILTER</button>

<br>

<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='addForm'>
    ADD <br>
    <label> Fullname:
        <input type='text' name='fullname'>
    </label><br>
    <label> state:
        <input type='text' name='state'>
    </label><br>
    <label> salary:
        <input type='number' name='salary'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <label> experience:
        <input type='text' name='experience'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit'>
</form>
<br>
<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='editForm'>
    EDIT <br>
    <label> id:
        <input type='number' name='code'>
    </label><br>
    <label> Fullname:
        <input type='text' name='fullname'>
    </label><br>
    <label> state:
        <input type='text' name='state'>
    </label><br>
    <label> salary:
        <input type='number' name='salary'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <label> experience:
        <input type='text' name='experience'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='filterForm'>
    Filter <br>
    <label>
        Children:<input type="text" name="z-children">
        State:<input type="text" name="z-state">
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit'>
</form>
<br>
<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='savefile'>
    <input type='hidden' name='action' value='savefile'>
    <input type='submit' value='Save to file'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='loadfile'>
    <input type='hidden' name='action' value='loadfile'>
    <input type='submit' value='Upload from file'>
</form>
<style>
    table,td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        border: 1px solid black;
    }
</style>
<script>
    function ShowAddForm() {
        document.querySelector('#addForm').style.display = 'inline';
    }
    function ShowEditForm() {
        document.querySelector('#editForm').style.display = 'inline';
    }
    function ShowFilterForm() {
        document.querySelector('#filterForm').style.display = 'inline';
    }
</script>