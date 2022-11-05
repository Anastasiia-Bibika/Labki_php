<?php
//Варіант 18
//1.Фільтрування введених даних в РНР.
//Відповідь: Зазвичай для фільтрування введених даних використовують типовий спосіб GET параметра, використовую індетифікатор
// користувача ID,або за використанням функції фільтрації даних filter
//2.На сервері зберігається список студентів Предметів (Id, Назва,
//Викладач, Кількість балів). Розробити Web сторінку для перегляду всього
//списку предметів. Розмістити біля кожного предмету кнопку для
//вилучення його даних.
class Repository{
    public function  __construct($dbh){
        $this->dbh = $dbh;
    }
    public function addSubjects(string $namesubject,string $professor,int $mark){
        $this->dbh->query('INSERT INTO subjects(namesubject, professor, mark) VALUES (' .
            "'" . $namesubject . "', " .
            "'" . $professor . "', " .
            "'" . $mark . "')"
        );
    }
    public function readSubjects()
    {
        return $this->dbh->query('SELECT * FROM subjects')->fetchAll();
    }
    public function deleteSubjects($id){
        return $this->dbh->query("DELETE FROM subjects WHERE id = " . $id);
    }
}
$dbh = new PDO('mysql:host=localhost;dbname=subject_db', 'root', '');
$subjectData = new Repository($dbh);

//$subjectData->addSubjects("Higher mathematics","Anatoly Dmitriyovich Kovalenko",89,);
foreach ($subjectData->readSubjects() as $value){
    $id = $value['id'];
    if(array_key_exists("btn$id", $_POST)){
        $subjectData->deleteSubjects($id);
    }
}
echo "<table border='1px solid'>";
foreach ($subjectData->readSubjects() as $value){
    $id = $value['id'];
    echo "<form method='post'> <tr>";
    echo '<td>' . $id . '</td>';
    echo '<td>' . $value['namesubject'] . '</td>';
    echo '<td>' . $value['professor'] . '</td>';
    echo '<td>' . $value['mark'] . '</td>';
    echo '<td>' . "<input type='submit' name='btn$id' id='btn$id' value='DELETE'/>" . '</td>';
    echo "</tr> </form>";
}
echo "</table>";
?>

