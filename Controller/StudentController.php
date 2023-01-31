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
        if($this->checkIfRequestWasMade()){
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

    /**
    * Reset html and its inner markups
    */
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
        $html = str_replace( '{{id}}', $studentData['id'], $html );
        return $html;
    }

    public function editStudent(){
        if($this->checkIfRequestWasMade()){
            $student = Student::getStudent($_REQUEST['id']);
            if($student){
                    $this->html = file_get_contents(PROJECT_ROOT . 'views/edit.html');
                    $this->html = str_replace('{{id}}', $_REQUEST['id'], $this->html);
                    $this->html = str_replace('{{nome}}', $student[0]['nome'], $this->html);
                    $this->html = str_replace('{{feedback}}', "", $this->html);
            }
        }
    }

    public function updateStudent(){
        if($this->checkIfRequestWasMade()){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/edit.html');
            $this->html = str_replace('{{id}}', $_REQUEST['id'], $this->html);
            $this->html = str_replace('{{nome}}', $_REQUEST['nome'], $this->html);
            $data[':id'] = $_REQUEST['id'];
            $data[':nome'] = $_REQUEST['nome'];
            $data[':email'] = $_REQUEST['email'];
            $data[':telefone'] = $_REQUEST['telefone'];
            $data[':situacao'] = $_REQUEST['situacao'];
            $data[':observacao'] = $_REQUEST['observacao'];
            $data[':mensalidade'] = $_REQUEST['mensalidade'];
            $updateStatus = Student::updateStudent($_REQUEST['id'], $data);
            if($updateStatus){
                $feedback = $this->getRegistrationFeedback('success', 'Edição realizada');
                $this->html = str_replace('{{feedback}}', $feedback, $this->html);
            }else{
                $feedback = $this->getRegistrationFeedback('failure', 'Erro ao editar dados do aluno');
                $this->html = str_replace('{{feedback}}', $feedback, $this->html);
            }
        }
    }
    

    public function show(){
        echo $this->html;
    }

    private function checkIfRequestWasMade(){
        if(isset($_REQUEST) && !empty($_REQUEST)){
            return true;
        }
        return false;
    }
}