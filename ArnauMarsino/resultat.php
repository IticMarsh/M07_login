<h1>Supermercat Online</h1>
<h2>Tots els productes</h2>

<?php   

    if(!$products){
        echo "Error en la consulta";
    }
    else{
        foreach($products as $i => $prod){
echo "Num de producte: ". $prod["product_id"];
echo "<br>";
echo "Nom de producte: ". $prod["name"];
echo "<br>";
echo "Preu de producte: ". $prod["price"];
echo "<br><br>";
        }
    }//else

mysqli_close($connect);

?>