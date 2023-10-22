<?php
//arxiu de configuracio
include ("dbConf.php");

//variables post del form 
$email=$_POST['email'];
$password=$_POST['password'];

// funció per fer la consulta de tots els usuaris quan el rol és professor.

function Users($connect, $query2) {
    $result = mysqli_query($connect, $query2);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return array(); // Devuelve un array vacío en caso de error
    }
}


//us del try i catch
try{
    $connect= mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);
    if($connect){
            // Select a la taula
            $query= "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password';";
            //bd
            $users= mysqli_query($connect, $query);

        if(mysqli_num_rows($users)>0){
            //iterar
             foreach($users as $user){
                //condicio alumne
                if($user['rol']=="alumnat"){
                        echo "Soc un alumne<br>";
                        echo "nom: ". $user['name']."<br>";
                        echo "cognom: ". $user['surname']."<br>";
                        echo "email: ". $user['email']."<br>";
                }
                //professorat
                elseif($user['rol']=="professorat"){
                        echo "Hola ".$user['name']." ".$user['surname'].", ets professor!! <br> <br>";
                        
                        $query2= "SELECT * FROM `user`";
                        $usuaris= Users($connect, $query2);
                        echo "La llista d'usuaris a la base de dades: <br>";
                    foreach($usuaris as $usuari){

                            echo "<br>nom i cognom: ". $usuari['name']." ".$usuari['surname'];
                        }
                    }
                }
            }else{
                include('form.html');
                echo "Els valors son incorrectes";
        }
    }

    }
    catch(PDOException $e){
        echo"Error de connecció en ".DB_NAME;
    }
    finally{
        mysqli_close($connect);
    }
?>

