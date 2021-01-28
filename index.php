<?php
    include 'db/mydbclass.php';
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>QUIZ</title>
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="new_user.php">
                    PROVA ANCHE TU!
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
                $max_questions = $db->max_id("SELECT test_id, COUNT(id) AS max_id FROM answers_given GROUP BY test_id ORDER BY max_id DESC LIMIT 1");
                for($i=1; $i <= $max_questions; $i++){
                    echo "<th>N° ".$i."</th>";
                }
            ?>
            <th>
                TOTALE
            </th>
        </thead>
        <tbody>
        <?php
            // $users = $db->selectAll("SELECT * FROM users");
            foreach ($db->selectAll("SELECT * FROM users") as $key => $user) {
                foreach ($db->selectAll("SELECT * FROM user_tests WHERE user_id = ".$user['id']." ORDER BY test_id ASC") as $keytest => $test) {
                    echo "<tr><td>".$user['nick']."</td><td>".($keytest+1)."</td>";
                    $answers = $db->selectALL("SELECT 	question_list_id, value FROM answers_given WHERE user_id = ".$user['id']." AND test_id = ".$test['test_id']." ORDER BY id ASC");
                    // print_r($answers);
                    $total_result = 0;
                    foreach ($answers as $key => $answer) {
                        // echo "<br><br><br><br>";
                        // print_r(($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = ".$answer['question_list_id']." AND correct = 1")));
                        // echo "<br><br><br><br>";
                        echo "<td>";
                        if ($answer['value'] == '') {
                            echo "0";
                        }elseif ($answer['value'] == ($db->selectOne("SELECT value FROM answers_lists WHERE questions_id = ".$answer['question_list_id']." AND correct = 1"))[0]['value']) {
                            echo "3";
                            $total_result+=3;
                        }else{
                            echo "-2";
                            $total_result-=2;
                        }
                        echo "</td>";
                    }
                    echo "<td>".$total_result."</td>";
                    
                }
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    
</body>
</html>