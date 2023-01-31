<?php
require './config.php';
require PROJECT_ROOT.'Model/Student.php';

class StudentController{
    private $html;

    function __construct(){
        $this->html = file_get_contents(PROJECT_ROOT.'views/register.html');
        $this->html = str_replace("{{feedback}}", '' , $this->html);
    }

    public function storeStudent(){
        if(isset($_REQUEST) && !empty($_REQUEST)){
            $this->resetHtml('views/register.html');
            if(Student::store($_REQUEST)){
                $feedback = $this->getRegistrationFeedback('success', 'Aluno Cadastrado com sucesso!');
                $this->html = str_replace("{{feedback}}", $feedback , $this->html);
                
            }else{
                $feedback = $this->getRegistrationFeedback('failure', 'Erro ao cadastrar aluno!');
                $this->html = str_replace("{{feedback}}", $feedback , $this->html);
            }
        }
    }
    private function getRegistrationFeedback($component = 'success', $msg = 'Student registered'){
        $feedbackComponent = file_get_contents(PROJECT_ROOT.'views/components/feedback/'.$component.'.html');
        $feedbackComponent = str_replace('{{msg}}', $msg, $feedbackComponent);
        return $feedbackComponent;
    }

    private function resetHtml($path = ''){
        $this->html = file_get_contents(PROJECT_ROOT.$path);
    }

    public function listStudents(){
        $this->html = file_get_contents(PROJECT_ROOT.'views/list.html');
        $students = Student::all();
        if(count($students) > 0){
            $this->populateListViewWithStudents($students);
            return;
        }
    }
    private function populateListViewWithStudents($students = []){
        $rowComponent = file_get_contents(PROJECT_ROOT . '/views/components/table/row.html');
        $rowComponentsList = '';
        foreach ($students as $student) {
            $rowComponentsList .= $rowComponent;
            $rowComponentsList = $this->getReplacedHtmlMarkupWithStudentData($rowComponentsList, $student);
        }
        $this->html = str_replace('{{list}}', $rowComponentsList, $this->html);
    }
    private function getReplacedHtmlMarkupWithStudentData($html, $studentData = []){
        $html = str_replace( '{{nome}}', $studentData['nome'], $html );
        $html = str_replace( '{{mensalidade}}', $studentData['mensalidade'], $html );
        $html = str_replace( '{{situacao}}', $studentData['situacao'], $html );
        $html = str_replace( '{{telefone}}', $studentData['telefone'], $html );
        $html = str_replace( '{{email}}', $studentData['email'], $html );
        $html = str_replace( '{{observacao}}', $studentData['observacao'], $html );
        return $html;
    }

    public function show(){
        echo $this->html;
    }
}