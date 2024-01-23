<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['koszyk'])){
    $_SESSION['koszyk'] = [];
}

include("cfg.php");

function AktualizujKoszyk($id, $ile){
    if($ile == 0){
        foreach($_SESSION['koszyk'] as $index => $produkt){
            if($produkt['id'] == $id){
                unset($_SESSION['koszyk'][$index]);
                break;  // Opcjonalnie przerwij pętlę, jeśli produkt został usunięty
            }
        }
    }
    elseif($ile == -1){
        foreach($_SESSION['koszyk'] as &$produkt){
            if($produkt['id'] == $id){
                $produkt['ile'] = $produkt['ile']+1;
                return;
            }
        }
        $_SESSION['koszyk'][] = ['id' => $id, 'ile' => 1];
        
        return "Dodano produkt do koszyka";
    }
    else{
        foreach($_SESSION['koszyk'] as &$produkt){
            if($produkt['id'] == $id){
                $produkt['ile'] = $ile;
                return;
            }
        }
        $_SESSION['koszyk'][] = ['id' => $id, 'ile' => $ile];

        return "Dodano produkt do koszyka";
    }
}

function WyswietlKoszyk(){
    $conn = GetConn();
    if(count($_SESSION['koszyk']) == 0){
        echo "Pusty koszyk";
    }
    else{
        $suma = 0;
        echo "<table>";
        foreach($_SESSION['koszyk'] as $produkt){
            $query = 'SELECT * FROM products WHERE id='.$produkt['id'].' LIMIT 1';
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            echo '<tr><td>'.$row['nazwa']." </td>";
            echo '<td class="log4_t">[ilość]</td>
            <td><form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
            <input type="number" name="ile" class="logowanie" value="'.$produkt['ile'].'"/>
            <button type="submit" name="edytuj" class="logowanie" value="'.$produkt['id'].'">aktualizuj</button></td>
            </tr></form>';
            $suma += ($row['cena_netto']+$row['vat'])*$produkt['ile'];
        }
        echo "</table><br><h2>suma:</h2><h3>".$suma."</h3>";
        
    }
}

function ListaProduktów(){
    $conn = GetConn();
    $query = 'SELECT * FROM products WHERE status=1 LIMIT 100';
    $result = mysqli_query($conn, $query);
    echo "<table>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>".$row['nazwa']."</td><td>".$row['opis']."</td><td>".$row['cena_netto']+$row['vat']." zł</td><td><img src=".$row['zdj']." width='100px' height='100px'></td>";
        echo '<td>
        <form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <button type="submit" name="edytuj" class="logowanie" value="'.$row['id'].'"/>dodaj do koszyka</button>
        </form>
        </td></tr>';
    }
    echo "</table>";
}

if(isset($_POST['edytuj'])){
    $ile = -1;
    if(isset($_POST['ile'])){
        $ile = $_POST['ile'];
    }
    echo AktualizujKoszyk($_POST['edytuj'],$ile);
}

//$_SESSION['koszyk'] = [];
echo '<h1>koszyk:</h1>';
WyswietlKoszyk();
echo '<h1>lista produktów:</h1>';
ListaProduktów();
?>
