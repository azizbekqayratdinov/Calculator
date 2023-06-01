<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Calculator</title>
    <style>
        b{
            color: royalblue;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <form action="" method="post">
            <label for="on" style="color:royalblue"><b>WebCalculator </b>: </label>
            <input type="text" placeholder="Считаю арифметику..." name="input" id="on">
            <input type="submit" value="=" class="btn btn-outline-primary">
        
    <b>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $input = $_POST['input'];
        $n = strlen($input);
         // 12+23

        function getAmel($array){
            global $n;
            for($i=0 ; $i<$n ; $i++){
                if(!is_numeric($array[$i]) and ($array[$i]=='+' or $array[$i]=='-' or $array[$i]=='*' or $array[$i]=='/')){
                    file_put_contents('belgi.txt' , $array[$i]);
                    file_put_contents('amelindex.txt' , $i);
                }
            }
           return file_get_contents('belgi.txt');
        }     

        $belgi = getAmel($input);
        $amelindex = file_get_contents('amelindex.txt');

        function san1($array){
            $newarr = [];
            global $belgi , $amelindex ;
            for($i=0; $i<$amelindex ; $i++){     
               array_push($newarr, $array[$i]);
            }
            return $newarr;
        }
        function san2($array){
            $newarr = [];
            global $belgi , $amelindex , $n;
            for($i=$amelindex+1; $i<$n ; $i++){     
                array_push($newarr , $array[$i]);
            }
            return $newarr;
        }
        file_put_contents('san1.json' , san1($input));
        file_put_contents('san2.json' , san2($input));
        
        $san1 = file_get_contents('san1.json');
        $san2 = file_get_contents('san2.json');

        if($belgi=='+'){
            echo ($san1 + $san2).'<br>';
        }elseif($belgi=='-'){
            echo ($san1 - $san2).'<br>';
        }elseif($belgi=='*'){
            echo ($san1 * $san2).'<br>';
        }elseif($belgi=='/'){
            echo ($san1 / $san2).'<br>';
        }else{
            echo "<br>Siz tek eki san ustinde arifmetikaliq amellerdi orinlay alasiz, misali:<br>12+23 , 23-12 , 12*23 , 23/12";
        }
    }
    ?>
    </b>
        </form>
    </div>
</body>
</html>