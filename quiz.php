<?php
    include 'db/mydbclass.php';
    session_start();
    echo "WELCOME ".$_SESSION['nick']."!<br><br><br><br>";
    $questions_text = array();
    $answers_text = array();
    foreach ($_SESSION['questions'] as $question_number => $question_id) {
        // echo "<br>number ".$question_number."<br>id ".$question_id;
        // if(array_key_exists('text', $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id))){
        //     $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)['text'];
            $questions_text[$question_number+1] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)[0]['text'];
            // $answer_text[] = $db->selectALL("SELECT * FROM answers_list WHERE ");
            $answers_text[$question_number+1] = $db->selectALL("SELECT * FROM answers_lists WHERE questions_id = ".$question_id);
        // }
    }
    // print_r($questions_text);
    // print_r($questions_text);
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // print_r($answers_text);
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Quiz</title>
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="index.php">
                    TORNA ALLA HOME
                </a>
            </li>
        </ul>
    </header>
    <form action="new_answer.php" method="post">
    
    <?php
        foreach ($questions_text as $key => $text) {
            echo "<div class='question'>";
            // echo "Domanda N° ".($key)."<br><br>";
            echo $key.") ".$text."<br><div class='answer'>";
            foreach ($answers_text[$key] as $id => $answer) {
                echo "
                    <input type='radio' name='".$key."' id='".$key.$id."' value='".($id+1)."'> 
                    <label for='".$key.$id."'>".$answer['text']."</label><br>";
            }
            echo "</div></div><br><br>";
        }
    ?>
    <input type="submit" value="fine">

    </form>
</body>
</html>