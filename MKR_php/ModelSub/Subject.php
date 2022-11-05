<?php
class Subjects
{
    public $id;
    public $namesubject;
    public $professor;
    public $mark;

    public function __construct($id, $array)
    {
        $this->id = $id;
        $this->namesubject = $array['namesubject'];
        $this->professor = $array['professor'];
        $this->mark = $array['mark'];
    }

}