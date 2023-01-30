<?php
require_once './config.php';

class StudentController{
    private $html;

    function __construct(){
        $this->html = file_get_contents(PROJECT_ROOT.'views/register.html');
    }

    public function listStudents(){
        $this->html = file_get_contents(PROJECT_ROOT.'views/list.html');
        $students = 0;
        for ($i=0; $i < 10; $i++) { 
            $students++;
        }
        $this->html = str_replace('{{list}}', $students, $this->html);
    }

    public function show(){
        echo $this->html;
    }
}