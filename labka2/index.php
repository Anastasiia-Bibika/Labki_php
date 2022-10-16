<?php
/*1. Об’єкт “Бухгалтерія” (Код, ПІБ; посада; заробітна плата; кількість дітей; стаж).
 Запит працюючих, які обіймають посаду Х і мають не більше, ніж Y дітей.*/

function defaultDataAccounts() {
    return [
        [
            'code'=> 1,
            'fullname' => "Dmitriy Yuriovich Prodan",
            'state' => "teacher",
            'salary'=>18000,
            'children'=> 18,
            'experience'=> "3 years"
        ],
        [
            'code'=> 2,
            'fullname' => "Georgy Ivanovych Kovalenko",
            'state' => "head teacher",
            'salary'=>20000,
            'children'=> 21,
            'experience'=> "5 years"
        ],
        [
            'code'=> 3,
            'fullname' => "Myroslava Andriivna Kruch",
            'state' => "director",
            'salary'=>23000,
            'children'=> 19,
            'experience'=> "7 years"
        ],
        [
            'code'=> 4,
            'fullname' => "Ioanna Michalivna Vetcka",
            'state' => "Educator",
            'salary'=>16000,
            'children'=> 20,
            'experience'=> "3 years"
        ],
    ];
}

function CreateNewAccount($array, $id) {
    return [
        'code' => $id,
        'fullname' => $array['fullname'],
        'state' => $array['state'],
        'salary' => $array['salary'],
        'children' => $array['children'],
        'experience' => $array['experience'],
    ];
}

function validationDataAccounts($array) {
    return !(
        empty($array['fullname']) ||
        empty($array['state']) ||
        empty($array['salary']) ||
        empty($array['children']) ||
        empty($array['experience']) ||
        ($array['children'] < 0) ||
        ($array['salary'] < 0) ||
        !isset($array)
    );
}
function sortByChildrenState($arr, $state,$children){
    $newArr = [];
    for($i = 0; $i < count($arr); $i++){
        if($state == $arr[$i]["state"] && $arr[$i]["children"] < $children || $arr[$i]["children"] == $children){
            array_push($newArr, $arr[$i]);

        }
    }
    return $newArr;
}
function displayTableAcc($array)
{
    $table = '<table>';
    $table .= '<tr> <th>code</th> <th>fullname</th> <th>state</th> <th>salary</th> <th>children</th> <th>experience</th></tr>';

    foreach($array as $item) {
        $table .= "<tr>" .
            "<td>$item[code]</td><td>$item[fullname]</td><td>$item[state]</td>" .
            "<td>$item[salary]</td><td>$item[children]</td> <td>$item[experience]</td>" .
            "</tr>";
    }

    $table .= '</table>';
    echo $table;
}

session_start();
$z_children = $_POST['z-children'];
$z_state = $_POST['z-state'];
$action = $_POST['action'];

if (empty($_SESSION)) {
    $_SESSION['Accounts'] = defaultDataAccounts();
}
// add
if ($action == 'add'){
    if (validationDataAccounts($_POST)) {
        $nextAccId = count($_SESSION['Accounts']) + 1;
        $_SESSION['Accounts'][] = CreateNewAccount($_POST, $nextAccId);
    }
}

// edit
if ($action == 'edit'){
    if (validationDataAccounts($_POST)) {
        $idToEdit = $_POST['code'];
        foreach ($_SESSION['Accounts'] as $key => $value) {
            if ($value['code'] == $idToEdit) {
                $_SESSION['Accounts'][$key] = CreateNewAccount($_POST, $idToEdit);
                break;
            }
        }
    }
}
// table all Cars
displayTableAcc($_SESSION['Accounts']);
// filter
if ($action == 'filter'){
    $arr = sortByChildrenState($_SESSION['Accounts'], $_POST['z-state'],$_POST['z-children']);
}
if ($action == 'savefile') {
    $file = fopen("accounts.txt", "w");
    fwrite($file, serialize($_SESSION['Accounts']));
    fclose($file);
} // loading
if ($action == 'loadfile') {
    $_SESSION['Accounts'] = unserialize(file_get_contents("accounts.txt"));
}
// filter table
echo "<h2> Таблиця після запиту</h2>";
echo "Запит: $z_children <br>";
echo "$z_state<br>";
echo "<table>";
echo "<tr> <th>code</th> <th>Fullname</th> <th>state</th> <th>salary</th> <th>children</th> <th>experience</th></tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
<br>

<button onclick="ShowAddForm()"> ADD </button>
<button onclick="ShowEditForm()"> EDIT </button>
<button onclick="ShowFilterForm()"> FILTER </button>

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
