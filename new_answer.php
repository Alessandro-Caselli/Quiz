<?php
    include 'db/mydbclass.php';
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // echo "POST: ";
        // print_r($_POST);
        // echo "<br>";
        $_SESSION['answers'] = $_POST;
        $_SESSION['results'] = array();
        // echo "QUESTIONS: ";
        // print_r($_SESSION['questions']);
        // echo "<br>";
        // echo "ANSWERS: ";
        // print_r($_SESSION['answers']);
        //question number is -1 (need to add 1)
        foreach ($_SESSION['questions'] as $question_number => $question_id) {
            $answer = (array_key_exists($question_number+1, $_POST) ? "'".$_POST[$question_number+1]."'" : "NULL");
            // echo "<br> domanda:      answer:    ".$answer."  question number+1   ".($question_number+1)."  question id   ".($question_id);
            $db->run_query("INSERT INTO answers_given (user_id, question_list_id, test_id, value) VALUES ('".$_SESSION['user_id']."', '".$question_id."', '".$_SESSION['test_id']."', ".$answer.")");
            // echo "<br> query: ".($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = ".($question_id+1)." AND correct = 1"))[0]['value']."<br>";
            // echo "<br>";
            // if(array_key_exists($question_number+1, $_SESSION['answers'])){
            //    echo $_SESSION['answers'][$question_number+1];
            // }
            // print_r($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = $question_id AND correct = 1"));
            // echo "<br>";
            if(!array_key_exists($question_number+1, $_SESSION['answers'])){
               $_SESSION['results'][$question_number+1] = 0;
            }elseif ($_SESSION['answers'][$question_number+1] == ($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = $question_id AND correct = 1"))[0]['value']) {
                $_SESSION['results'][$question_number+1] = 3;
            }else {
                $_SESSION['results'][$question_number+1] = -2;
            }

            // if(array_key_exists($question_number+1, $_SESSION['answers'])){
            //    echo $_SESSION['answers'][$question_number+1]. "<br><br><br><br>";
            // }
            


            
        }
        // print_r($_SESSION['results']);
        header('Location: results.php');
    }
?>