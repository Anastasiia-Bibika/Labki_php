<?php
//Варіант 18
//1.Фільтрування введених даних в РНР.
//Відповідь: Зазвичай для фільтрування введених даних використовують типовий спосіб GET параметра, використовую індетифікатор
// користувача ID,або за використанням функції фільтрації даних filter
//2.На сервері зберігається список студентів Предметів (Id, Назва,
//Викладач, Кількість балів). Розробити Web сторінку для перегляду всього
//списку предметів. Розмістити біля кожного предмету кнопку для
//вилучення його даних.
function defaultSubjectsData() {
    return [
        [
            'id'=> 1,
            'namesubject' => "Higher mathematics",
            'professor' => "Anatoly Dmitriyovich Kovalenko",
            'mark'=>89,
        ],
        [
            'id'=> 2,
            'namesubject' => "Informatics",
            'professor' => "Volodymir Andriyovich Borysenko",
            'mark'=>100,
        ],
        [
            'id'=> 3,
            'namesubject' => "Discrete Math",
            'professor' => "Iryna Ivanivna Mykhailenko",
            'mark'=>85,
        ],
        [
            'id'=> 4,
            'namesubject' => "Basics of Python programming",
            'professor' => "Kyrylo Igorovich Rybchynskyi",
            'mark'=>95,
        ],
    ];
}

$dbh = new PDO('mysql:host=127.0.0.1;dbname=subject_db', 'root', '');
$sql = "SELECT * FROM subjects;";

function addSubjectDB(string $otherNamesubject,string $otherProfessor,int $otherMark,$dbh){
    $dbh->query('');
}
function DeleteSubject($array, $id) {
    return
        array_splice($array,$id);
}
function validationSubjectsData($array) {
    return !(
        empty($array['namesubject']) ||
        empty($array['professor']) ||
        empty($array[ 'mark']) ||
        ($array['mark'] < 0) ||
        !isset($array)
    );
}
function displayTableSubjects($array)
{
    $table = '<table>';
    $table .= '<tr> <th>id</th> <th>namesubject</th> <th>professor</th> <th>mark</th> </tr>';

    foreach($array as $item) {
        $table .= "<tr>" .
            "<td>$item[id]</td><td>$item[namesubject]</td><td>$item[professor]</td>" .
            "<td>$item[mark]</td>" .
            "</tr>";
    }

    $table .= '</table>';
    echo $table;
}
$action = $_POST['action'];

if (empty($_SESSION)) {
    $_SESSION['Subjects'] = defaultSubjectsData();
}
displayTableSubjects($_SESSION['Subjects']);
if ($action == 'loadfile') {
    $_SESSION['Subjects'] = unserialize(file_get_contents("subjects.txt"));
}
if ($action == 'delete'){
    if (validationSubjectsData($_POST)) {
        $idToDelete = $_POST['id'];
        foreach ($_SESSION['Subjects'] as $key => $value) {
            if ($value['id'] == $idToDelete) {
                $_SESSION['Subjects'][$key] = DeleteSubject($_POST, $idToDelete);
                break;
            }
        }
    }
}
?>
<br>

<button onclick="Deleteform()"> DELETE </button>

<br>
<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='deleteForm'>
    DELETE <br>
    <label> Namesubject:
        <input type='text' name='namesubject'>
    </label><br>
    <label> Professor:
        <input type='text' name='professor'>
    </label><br>
    <label> Mark:
        <input type='number' name='mark'>
    </label><br>
    <input type='hidden' name='action' value='delete'>
    <input type='submit'>
</form>
<br>
//3.Реалізувати завдання 2 з використанням бази даних.
<style>
    table,td {
        border: 2px solid darkgrey;
        border-collapse: collapse;
    }
    th{
        border: 2px solid black;
        border-radius: 5px;
    }
</style>
<script>
    function Deleteform() {
        document.querySelector('#deleteForm').style.display = 'inline';
    }
</script>