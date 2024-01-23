<?php
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['confirmed'])){
        $_SESSION['confirmed'] = false;
    }

    include("php/cfg.php");
    
    $cfgpass = $pass;
    $cfglogin = $login;

// ||--------------Ekran Logowania--------------||

    function Logowanie(){
        $wynik = '
        <div class="logowanie">
         <h1 class="heading">Panel CMS:</h1>
         <div class="logowanie">
          <form method="post" name="LoginForm" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
           <table class="logowanie">
            <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie" required /></td></tr>
            <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie" required /></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Zaloguj"/></td></tr>
           </table>
          </form>
         </div>
        </div>
        ';
        return $wynik;
    }

// ||--------------Funkcja Do Wylogowywania--------------||

    function Wylogowywanie(){
        return '<br/>
        <form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
           <table class="logowanie">
            <tr><td>&nbsp;</td><td><input type="submit" name="wyloguj" class="logowanie" value="Wyloguj"/></td></tr>
           </table>
          </form>
        ';
    }

// ||--------------Listowanie Stron Z Bazy Danych--------------||

    function ListaPodstron(){
        $conn = GetConn();
        $query="SELECT * FROM page_list LIMIT 100";
        $result = mysqli_query($conn,$query);
        echo '<form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table>';
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>'.$row['id'].'</td><td>'.$row['page_title'].
                '</td><td><button type="submit" name="usun" class="logowanie" value="'.$row['id'].'"/>usuń</button>'.
                '</td><td><button type="submit" name="edytuj" class="logowanie" value="'.$row['id'].'">edytuj</button></td></tr>';
        }
        echo '</table></form>';
        echo '<form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <tr><td>&nbsp;</td><td><input type="submit" name="dodaj" class="logowanie" value="Dodaj nową stronę"/></td></tr>
        </form>';
    }

// ||--------------Funkcja Edytująca Stronę W Bazie Danych--------------||

    function EdytujPodstrone($id){
        $query='SELECT * FROM page_list WHERE id = '.$id;
        $row;
        if($id == 0){
            $row = [
                "id" => 0,
                "page_title" => "",
                "page_content" => "",
                "status" => 0
            ];
        }
        else{
            $conn = GetConn();
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
        }
        $dodaj = "";
        if($row['status'] == 1){
            $dodaj = " checked";
        }
        $content = $row['page_content'];
        return '
        <div class="logowanie">
         <div class="logowanie">
          <form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
           <table class="logowanie">
           <input type="hidden" name="id" value="'.$row['id'].'" />
            <tr><td class="log4_t">[tytuł]</td><td><input type="text" name="tytul" class="logowanie" required value="'.$row['page_title'].'"/></td></tr>
            <tr><td class="log4_t">[zawartość]</td><td><textarea name="content" class="logowanie" required>'.$row['page_content'].'</textarea></td></tr>
            <tr><td class="log4_t">[status]</td><td><input type="checkbox" name="status" class="logowanie"'.$dodaj.'/></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Wyślij"/></td></tr>
           </table>
          </form>
         </div>
        </div>
        ';
    }

// ||--------------Sprawdzanie Czy Zmienna POST Istnieje--------------||

    function CheckPost($val){
        if(isset($_POST[$val])){
            return true;
        }
        return false;
    }

// ||--------------Dodawanie Nowej Strony Do Bazy Danych--------------||

    function DodajNowaPodstrone(){
        return EdytujPodstrone(0);
    }

// ||--------------Usuwanie Strony Z Bazy Danych--------------||

    function UsunPodstrone($id){
        $conn = GetConn();
        $query = 'DELETE FROM page_list WHERE id='.$id.' LIMIT 1';
        $result = mysqli_query($conn, $query);
        if($result) {
            echo "Record with id $id deleted successfully!";
        }
        else {
            echo "Error";
        }
    }

    function PokazKategorie($id, $nazwa, $poziom){
        $conn = GetConn();
        $query = "SELECT * FROM categories WHERE matka = ".$id." LIMIT 100";
        $result = mysqli_query($conn,$query);
        $text = '<tr>';
        $text .= '<td>';
        for($i = 0; $i < $poziom; $i++){
            $text .= "-";
        }
        $text .= $id.'</td><td>'.$nazwa;
        $text .= '</td><td><button type="submit" name="usun_kategorie" class="logowanie" value="'.$id.'"/>usuń</button>';
        $text .= '</td><td><button type="submit" name="edytuj_kategorie" class="logowanie" value="'.$id.'">edytuj</button></td></tr>';
        echo $text;
        while($row = mysqli_fetch_array($result)){
            PokazKategorie($row['id'], $row['nazwa'], $poziom+1);
        }
    }
    
    function ListaKategorii(){
        $conn = GetConn();
        $query="SELECT * FROM categories WHERE matka = 0 LIMIT 100";
        $result = mysqli_query($conn,$query);
        echo '<form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table>';
        while($row = mysqli_fetch_array($result)){
            PokazKategorie($row['id'], $row['nazwa'], 0);
        }
        echo '</table></form>';
        echo '<form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <tr><td>&nbsp;</td><td><input type="submit" name="dodaj_kategorie" class="logowanie" value="Dodaj nową kategorię"/></td></tr>
        </form>';
    }

    function EdytujKategorie($id){
        $query='SELECT * FROM categories WHERE id = '.$id;
        $row;
        if($id == 0){
            $row = [
                "id" => 0,
                "matka" => 0,
                "nazwa" => ""
            ];
        }
        else{
            $conn = GetConn();
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
        }
        return '
        <div class="logowanie">
         <div class="logowanie">
          <form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
           <table class="logowanie">
           <input type="hidden" name="id" value="'.$row['id'].'" />
            <tr><td class="log4_t">[nazwa]</td><td><input type="text" name="nazwa" class="logowanie" required value="'.$row['nazwa'].'"/></td></tr>
            <tr><td class="log4_t">[matka]</td><td><input type="number" name="matka" class="logowanie" value="'.$row['matka'].'"/></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Wyślij"/></td></tr>
           </table>
          </form>
         </div>
        </div>
        ';
    }

    function DodajNowaKategorie(){
        return EdytujKategorie(0);
    }

    function UsunKategorie($id){
        $conn = GetConn();
        $query = 'DELETE FROM categories WHERE id='.$id.' LIMIT 1';
        $result = mysqli_query($conn, $query);
        if($result) {
            echo "Record with id $id deleted successfully!";
        }
        else {
            echo "Error";
        }
    }

    //produkty
    
    function ListaProduktow(){
        $conn = GetConn();
        $query="SELECT * FROM products LIMIT 100";
        $result = mysqli_query($conn,$query);
        echo '<form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"><table>';
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>'.$row['id'].'</td><td>'.$row['nazwa'].
                '</td><td><button type="submit" name="usun_produkt" class="logowanie" value="'.$row['id'].'"/>usuń</button>'.
                '</td><td><button type="submit" name="edytuj_produkt" class="logowanie" value="'.$row['id'].'">edytuj</button></td></tr>';
        }
        echo '</table></form>';
        echo '<form method="post" name="Wyloguj" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <tr><td>&nbsp;</td><td><input type="submit" name="dodaj_produkt" class="logowanie" value="Dodaj nowy produkt"/></td></tr>
        </form>';
    }

    function EdytujProdukt($id){
        $query='SELECT * FROM products WHERE id = '.$id;
        $row;
        if($id == 0){
            $row = [
                "id" => 0,
                "nazwa" => "",
                "opis" => "",
                "data_wygasniecia" => "2100-12-31",
                "cena_netto" => 0.00,
                "vat" => 0.00,
                "ilosc" => 0,
                "status" => 0,
                "kategoria" => 0,
                "gabaryt" => 0,
                "zdj" => ""
            ];
        }
        else{
            $conn = GetConn();
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
        }
        $dodaj = "";
        if($row['status'] == 1){
            $dodaj = " checked";
        }
        return '
        <div class="logowanie">
         <div class="logowanie">
          <form method="post" encrype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
           <table class="logowanie">
           <input type="hidden" name="id" value="'.$row['id'].'" />
            <tr><td class="log4_t">[nazwa]</td><td><input type="text" name="produkt_name" class="logowanie" required value="'.$row['nazwa'].'"/></td></tr>
            <tr><td class="log4_t">[opis]</td><td><textarea name="opis" class="logowanie" required>'.$row['opis'].'</textarea></td></tr>
            <tr><td class="log4_t">[data wygaśnięcia]</td><td><input type="date" name="exp_date" class="logowanie" required value="'.$row['data_wygasniecia'].'"/></td></tr>
            <tr><td class="log4_t">[cena netto]</td><td><input type="number" name="netto" min="0" step="0.01" class="logowanie" required value="'.$row['cena_netto'].'"/></td></tr>
            <tr><td class="log4_t">[vat]</td><td><input type="number" name="vat" min="0" step="0.01" class="logowanie" required value="'.$row['vat'].'"/></td></tr>
            <tr><td class="log4_t">[ilość na magazynie]</td><td><input type="number" name="ilosc" min="0" step="1" class="logowanie" required value="'.$row['ilosc'].'"/></td></tr>
            <tr><td class="log4_t">[status]</td><td><input type="checkbox" name="produkt_status" class="logowanie"'.$dodaj.'/></td></tr>
            <tr><td class="log4_t">[kategoria]</td><td><input type="number" name="kategoria" min="0" step="1" class="logowanie" required value="'.$row['kategoria'].'"/></td></tr>
            <tr><td class="log4_t">[gabaryt]</td><td><input type="number" name="gabaryt" min="0" step="0.01" class="logowanie" required value="'.$row['gabaryt'].'"/></td></tr>
            <tr><td class="log4_t">[zdjęcie]</td><td><textarea name="zdj" class="logowanie" required>'.$row['zdj'].'</textarea></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Wyślij"/></td></tr>
           </table>
          </form>
         </div>
        </div>
        ';
    }

    function DodajNowyProdukt(){
        return EdytujProdukt(0);
    }

    function UsunProdukt($id){
        $conn = GetConn();
        $query = 'DELETE FROM products WHERE id='.$id.' LIMIT 1';
        $result = mysqli_query($conn, $query);
        if($result) {
            echo "Record with id $id deleted successfully!";
        }
        else {
            echo "Error";
        }
    }

    function PokazListy(){
        echo "<h1>Podstrony:</h1>";
        ListaPodstron();
        echo "<h1>Kategorie:</h1>";
        ListaKategorii();
        echo "<h1>Produkty:</h1>";
        ListaProduktow();
    }
?>

<!DOCTYPE html>
<html>
<body>
    
<?php
    
    // ||--------------Sprawdzanie Logowania--------------||

    if(isset($_POST['login_email']) and isset($_POST['login_pass'])){
        if($_POST['login_email'] == $login and $_POST['login_pass'] == $pass){
            $_SESSION['confirmed'] = true;
        }
    }
    
    // ||--------------Sprawdzanie Wylogowywania--------------||
    
    elseif(isset($_POST['wyloguj'])){
        $_SESSION['confirmed'] = false;
    }

    // ||--------------Zalogowanie--------------||
    
    if($_SESSION['confirmed']){
        
        // ||--------------Usuwanie Strony--------------||
        if(CheckPost('usun')){
            UsunPodstrone($_POST['usun']);
        }
        
        elseif(CheckPost('usun_kategorie')){
            UsunKategorie($_POST['usun_kategorie']);
        }
        
        elseif(CheckPost('usun_produkt')){
            UsunProdukt($_POST['usun_produkt']);
        }
        
        // ||--------------Ekran Edytowania Strony--------------||
        if(isset($_POST['edytuj'])){
            echo EdytujPodstrone($_POST['edytuj']);
        }
        
        elseif(isset($_POST['edytuj_kategorie'])){
            echo EdytujKategorie($_POST['edytuj_kategorie']);
        }
        
        elseif(isset($_POST['edytuj_produkt'])){
            echo EdytujProdukt($_POST['edytuj_produkt']);
        }
        
        // ||--------------Ekran Tworzenia Strony--------------||
        elseif(CheckPost('dodaj')){
            echo DodajNowaPodstrone();
        }
        
        elseif(CheckPost('dodaj_kategorie')){
            echo DodajNowaKategorie();
        }
        
        elseif(CheckPost('dodaj_produkt')){
            echo DodajNowyProdukt();
        }
        
        // ||--------------Tworzenie I Edytowanie Strony--------------||
        elseif(CheckPost('id') and CheckPost('tytul') and CheckPost('content')){
            $conn = GetConn();
            $bool = 0;
            if(isset($_POST['status'])){
                $bool = 1;
            }
            $query = "";
            if($_POST['id'] == 0){
                $query = 'INSERT INTO page_list(page_title, page_content, status) VALUES("'.addslashes($_POST['tytul']).'","'.addslashes($_POST['content']).'",'.$bool.');';
            }
            else{
                $query='UPDATE page_list SET page_title="'.addslashes($_POST['tytul']).'",page_content="'.addslashes($_POST['content']).'",status='.$bool.' WHERE id='.$_POST['id'].' LIMIT 1';
            }
            $result = mysqli_query($conn, $query);
            if($result) {
                echo "Record updated successfully";
            }
            else {
                echo "Error";
            }
            PokazListy();
        }  
        elseif(CheckPost('id') and CheckPost('produkt_name') and CheckPost('opis') and CheckPost('exp_date') and CheckPost('netto') and CheckPost('vat') and CheckPost('ilosc') and CheckPost('produkt_status') and CheckPost('kategoria') and CheckPost('gabaryt') and CheckPost('zdj')){
            $conn = GetConn();
            $query = "";
            $bool = 0;
            if(isset($_POST['produkt_status'])){
                $bool = 1;
            }
            if($_POST['id'] == 0){
                $query = 'INSERT INTO products(nazwa, opis, data_modyfikacji, data_wygasniecia, cena_netto, vat, ilosc, status, kategoria, gabaryt, zdj)
                VALUES("'.addslashes($_POST['produkt_name']).'",
                "'.addslashes($_POST['opis']).'",
                "'.date("Y-m-d").'",
                "'.addslashes($_POST['exp_date']).'",
                "'.addslashes($_POST['netto']).'",
                "'.addslashes($_POST['vat']).'",
                "'.addslashes($_POST['ilosc']).'",
                "'.$bool.'",
                "'.addslashes($_POST['kategoria']).'",
                "'.addslashes($_POST['gabaryt']).'",
                "'.addslashes($_POST['zdj']).'");';
            }
            else{
                $query='UPDATE products SET
                nazwa="'.addslashes($_POST['produkt_name']).'",
                opis="'.addslashes($_POST['opis']).'",
                data_wygasniecia="'.date("Y-m-d").'",
                data_modyfikacji="'.addslashes($_POST['exp_date']).'",
                cena_netto="'.addslashes($_POST['netto']).'",
                vat="'.addslashes($_POST['vat']).'",
                ilosc="'.addslashes($_POST['ilosc']).'",
                status="'.$bool.'",
                kategoria="'.addslashes($_POST['kategoria']).'",
                gabaryt="'.addslashes($_POST['gabaryt']).'",
                zdj="'.addslashes($_POST['zdj']).'" 
                WHERE id='.$_POST['id'].' LIMIT 1';
            }
            $result = mysqli_query($conn, $query);
            if($result) {
                echo "Record updated successfully";
            }
            else {
                echo "Error";
            }
            PokazListy();
        }
        elseif(CheckPost('id') and CheckPost('nazwa') and CheckPost('matka')){
            $conn = GetConn();
            $query = "";
            if($_POST['id'] == 0){
                $query = 'INSERT INTO categories(matka, nazwa) VALUES("'.addslashes($_POST['matka']).'","'.addslashes($_POST['nazwa']).'");';
            }
            else{
                $query='UPDATE categories SET nazwa="'.addslashes($_POST['nazwa']).'",matka="'.addslashes($_POST['matka']).'" WHERE id='.$_POST['id'].' LIMIT 1';
            }
            $result = mysqli_query($conn, $query);
            if($result) {
                echo "Record updated successfully";
            }
            else {
                echo "Error";
            }
            PokazListy();
        }
        // ||--------------Pokazanie Listy Stron I Produktów--------------||
        else{
            PokazListy();
        }
        // ||--------------Wczytanie Przycisku Wylogowywania--------------||
        echo Wylogowywanie();
    }
    else{
        // ||--------------Formularz Logowania--------------||
        echo Logowanie();
    }
?>
    
</body>
</html>