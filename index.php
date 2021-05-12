<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
    <?php 
        include("traitement.php");
    ?>
    <div class="container">
    <form name="form" method="post" action="">
        <label for="test">Choisi donc !</label>
            <select name="option" size="1">
                <option value="DOMAC">DOMAC</option>
                <option value="TACOS">Tacos</option>
                <option value="KEBAB">Kebab</option>
                <option value="PIZZA">Pizza</option>
                <option value="SALADE">Salade</option>

    <?php
        $query = "SELECT * FROM option";
        $req = $bdd->prepare($query);
        $req->execute();
        $row = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $option)
    ?>
            </select>
                <label><input type="checkbox" class="check" name="case">Supplément Frite 0.70ct</label>
                <label><input type="checkbox" class="check" name="case">Supplément Sauce Fromagère 1.00€</label>
                <label><input type="checkbox" class="check" name="case">Supplément Oignon 0.50ct</label>
                <label><input type="checkbox" class="check" name="case">Supplément Sauce Ketchup 0.40ct</label>
                <label><input type="checkbox" class="check" name="case">Supplément Lardons 0.60ct</label>
            <a href="#"><input type="submit" class="submit" name="envoyer" value="Envoyer"></a>

            <?php
            if(isset($_POST['envoyer'])){
                $option = !empty($_POST['option']) ? $_POST['option'] : NULL;
                $case = !empty($_POST['case']) ? $_POST['case'] : NULL;

                $arr = array('option' => $option, 'case' => $case);

                $infos = json_encode($arr);

                $query = "INSERT INTO commande (menu) VALUES (?)";
                $req = $bdd->prepare($query);
                $req->execute([$infos]);
            }
            ?>
    </form>
    </div>

    </body>
</html>