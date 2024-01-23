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
            <tr><td>&nbsp;</td><td><input type="submit" name="dodaj" class="logowanie" value="Dodaj nową stronę"/></td></tr>
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
        
        // ||--------------Ekran Edytowania Strony--------------||
        if(isset($_POST['edytuj'])){
            echo EdytujPodstrone($_POST['edytuj']);
        }
        
        // ||--------------Ekran Tworzenia Strony--------------||
        elseif(CheckPost('dodaj')){
            echo DodajNowaPodstrone();
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
            ListaPodstron();
        }  
        // ||--------------Pokazanie Listy Stron--------------||
        else{
            echo ListaPodstron();
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