<?php
    include 'db/mydbclass.php';
    session_start();
    $total_score=0;
    foreach ($_SESSION['results'] as $key => $score) {
        $total_score += $score;
    }
    // foreach ($_SESSION['questions'] as $question_number => $question_id) {
    //     echo "<br>number ".$question_number."<br>id ".$question_id;
    //     // if(array_key_exists('text', $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id))){
    //     //     $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)['text'];
    //         $questions_text[$question_number+1] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)[0]['text'];
    //         // $answer_text[] = $db->selectALL("SELECT * FROM answers_list WHERE ");
    //         $answers_text[$question_number+1] = $db->selectALL("SELECT * FROM answers_lists WHERE questions_id = ".$question_id);
    //     // }
    // }
    $answers = $db->selectALL("SELECT * FROM answers_lists WHERE ");
    foreach ($_SESSION['questions'] as $question_number => $question_id) {
        // echo "<br>number ".$question_number."<br>id ".$question_id;
        // if(array_key_exists('text', $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id))){
        //     $questions_text[] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)['text'];
            $questions_text[$question_number+1] = $db->selectOne("SELECT text FROM questions_list WHERE id = ".$question_id)[0]['text'];
            // $answer_text[] = $db->selectALL("SELECT * FROM answers_list WHERE ");
            $answers_text[$question_number+1] = $db->selectALL("SELECT * FROM answers_lists WHERE questions_id = ".$question_id);
            $correct[$question_number+1] = ($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = $question_id AND correct = 1"))[0]['value'];
        // }
    }
    // print_r($correct);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Risultati</title>
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
    <table class='index_table'>
        <thead>
            <th>
                NOME
            </th>
            <th>
                TEST N°
            </th>
            <?php
                foreach ($_SESSION['questions'] as $question_number => $question_id) {
                    echo "<th>N° ".($question_number+1)."</th>";
                }
            
            ?>
            <th>
                TOTALE
            </th>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <?php
                            echo $_SESSION['nick'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo ($db->selectOne("SELECT COUNT(user_id) AS test FROM user_tests WHERE user_id = ".$_SESSION['user_id']))[0]['test'];
                        ?>
                    </td>
                    <?php
                       foreach ($_SESSION['questions'] as $question_number => $question_id) {
                            echo "<td>".$_SESSION['results'][$question_number+1]."</td>";
                       }
                    ?>
                    <td>
                       <?php
                           echo $total_score;                    
                       ?>
                    </td>     
                </tr>
        </tbody>
    </table>
    <br><br><br><br><br><br><br>
    <form action="" method="post">
    <?php
        //  print_r($_SESSION['results']);
        //  echo "<br>";
        //  print_r($_SESSION['answers']);
        foreach ($questions_text as $key => $text) {
            echo "<div class='question'>";
            // echo "Domanda N° ".($key)."<br><br>";
            echo $key.") ".$text."<br><div class='answer'>";
            foreach ($answers_text[$key] as $id => $answer) {
                echo $key."<p";
                if ($_SESSION['results'][$key] == 3 && $_SESSION['answers'][$key] == $id+1) {
                    echo " style='color:green;'>";
                }elseif ($_SESSION['results'][$key] != 3 && array_key_exists(($key), $_SESSION['answers']) && $_SESSION['answers'][$key] == $id+1) {
                    echo " style='color:red;'>";
                }else {
                    echo ">";
                }
                echo"<input type='radio' name='".$key."' id='".$key.$id."' value='".($id+1)."'";
                if(($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = ".$_SESSION['questions'][$key-1]." AND correct = 1"))[0]['value'] == $id+1){
                    echo "checked";
                }
                echo "><label for='".$key.$id."'>";
                echo $answer['text']."</p></label>";
            }
            echo "</div></div><br><br>";
        }
    ?>
    </form>
</body>
</html>