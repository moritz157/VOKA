<?
    include("config.php");

    if(isset($_POST["session-id"])){
        $pdo=new PDO('mysql:host=localhost;dbname='.$mysqlDatabase, $mysqlUser, $mysqlPass);
    
        $sql = "SELECT * FROM sessions WHERE `id`='".$_POST["session-id"]."'";
        $validSess=false;
        foreach ($pdo->query($sql) as $row){
            if($row["expires"]>time()){
                $validSess=true;
            }
        }
        if($validSess==true){  
            echo '{"substantive":[';
            //Substantive
            $sql = "SELECT * FROM substantive";
            $comma=false;
            foreach ($pdo->query($sql) as $row) {
                if($comma){
                    echo ',';
                }
                echo '{"inf_lat":"'.$row["inf_lat"].'", "gen_lat":"'.$row["gen_lat"].'", "genus":"'.$row["genus"].'", "ger":"'.$row["ger"].'", "tags":"'.$row["tags"].'", "lektion":"'.$row["lektion"].'", "author":"'.$row["author"].'"}';
                $comma=true;
            }
            echo ']}';
        }else{
            echo '{"err":"Invalid session-id"}'; 
        }
    }else{
        echo '{"err":"No session-id"}';
    }
?>