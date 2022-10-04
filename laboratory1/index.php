<?php
/*1. Об’єкт “Бухгалтерія” (Код, ПІБ; посада; заробітна плата; кількість дітей; стаж).
 Запит працюючих, які обіймають посаду Х і мають не більше, ніж Y дітей.*/
session_start();
$_SESSION["accounting"] = null;
if (isset($_SESSION["accounting"])){
    $accounting = $_SESSION["accounting"];
}else{
    $accounting = [
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
function getId($accounting){
    for($i = 0; $i < count($accounting); $i++){
        if($_GET["id"] == $accounting[$i]["code"]){
            $max = $accounting[0]["code"];
            for($j = 0; $j < count($accounting); $j++){
                if($accounting[$j]["code"] > $max){
                    $max = $accounting[$j]["code"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["code"];
}
if($_GET["edit"] != null){
    for($i = 0; $i < count($accounting); $i++){
        if($_GET["edit"] == $accounting[$i]["code"]){
            $accounting[$i] = ["code" => getId($accounting),
                "fullname" => $_GET["fullname"],
                "state" => $_GET["state"],
                "salary" => $_GET["salary"],
                "children" => $_GET["children"],
                'experience' => $_GET['experience']];
            $_SESSION["accounting"] = $accounting;
            break;
        }
    }

}
else{
    if($_GET["code"] == null){
        $_GET["code"] = 1;
    }
    if($_GET["fullname"] == null){
        $_GET["fullname"] = "None fullname";
    }
    if($_GET["state"] == null){
        $_GET["state"] = "None state";
    }
    if($_GET["salary"] == null){
        $_GET["salary"] = "0";
    }
    if($_GET["children"] == null){
        $_GET["children"] = "0";
    }
    if($_GET["experience"] == null){
        $_GET["experience"] = "0 years";
    }

    $accounting[] = ["code" => getId($accounting),
        "fullname" => $_GET["fullname"],
        "state" => $_GET["state"],
        "salary" => $_GET["salary"],
        "children" => $_GET["children"],
        "experience" => $_GET["experience"]];
    $_SESSION["factory"] = $accounting;
}
function sortByChildrenState($arr, $state,$children){
    $newArr = [];
    for($i = 0; $i < count($arr); $i++){
        if($state == $arr[$i]["state"] && $arr[$i]["children"] > $children){
            array_push($newArr, $arr[$i]);

        }
    }
    return $newArr;
}

echo "<h2>Таблиця всіх значень</h2>";
echo "<table>";
echo "<tr> <th>Code</th> <th>Fullname</th> <th>State</th> <th>Salary</th> <th>Children</th> <th>Experience</th> </tr>";
for($i = 0; $i < count($accounting); $i++){
    echo "<tr>";
    foreach ($accounting[$i] as $key=>$value){
        if($value != null){
            echo "<td>$value</td>";
        }

    }

    echo "</tr>";
}
echo "</table>";

$arr = sortByChildrenState($accounting,"head teacher",20);
echo "<h2>Таблиця запиту</h2>";
echo "<table>";
echo "<tr> <th>Code</th> <th>Fullname</th> <th>State</th> <th>Salary</th> <th>Children</th> <th>Experience</th></tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";


?>
<style>
    table{
        border: 1px solid black;
    }
    th,tr,td{
        border: 1px solid black;
    }
</style>

<form method="get" action="">
    <p>Form</p>
    <label>
    <input type="number" name="edit" placeholder="Type id for edit"> <br>
    <input type="number"  name="code" placeholder="Code"> <br>
    <input type="text"  name="fullname" placeholder="Fullname"> <br>
    <input type="text" name="state" placeholder="State"> <br>
    <input type="number" name="salary"  placeholder="Salary"> <br>
    <input type="number" name="children" placeholder="Children"><br>
    <input type="text" name="experience" placeholder="Experience"><br>
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="z-children" value="">
    <input type="hidden" name="z-state" value="">
    </label>
</form>