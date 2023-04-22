<?php
    Class Database{

        private $server = "mysql:host=localhost;dbname=doctors";
        private $username = "root";
        private $password = "";
        private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
        protected $conn;
 	
        public function open(){
            
            try{
                
                $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
                return $this->conn;
            }
            catch (PDOException $e){
                
                echo "There is some problem in connection: " . $e->getMessage();
            }
 
        }
 
	public function close(){
   		$this->conn = null;
 	}
 
    }

    $pdo = new Database();
    
    session_start();
    
    if(isset($_SESSION['user'])){
        
        $conn = $pdo->open();

        try{
                  $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
                  $stmt->execute(['id'=>$_SESSION['user']]);
                  $user = $stmt->fetch();
        }
        catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
        }

        $pdo->close();
    }

  if(!isset($_GET['code']) OR !isset($_GET['user'])){
      header('location: https://myplateug.com/');
      exit(); 
  }

  $path = '../password_reset.php?code='.$_GET['code'].'&user='.$_GET['user'];

  if(isset($_POST['password'])){
            $password = filter_input(INPUT_POST, 'password');
            $repassword = filter_input(INPUT_POST, 'repassword');

            if($password != $repassword){
                      $_SESSION['error'] = 'Passwords did not match';
                      echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../password_reset.php?code=".$_GET['code']."&user=".$_GET['user']."&login=Passwords did not match' />";
            }
            else{
                      $conn = $pdo->open();

                      $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE reset_code=:code AND id=:id");
                      $stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
                      $row = $stmt->fetch();

                      if($row['numrows'] > 0){
                                $password = md5($password);

                                try{
                                          $stmt = $conn->prepare("UPDATE users SET password=:password WHERE id=:id");
                                          $stmt->execute(['password'=>$password, 'id'=>$row['id']]);

                                          $_SESSION['success'] = 'Password successfully reset';
                                          echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../index.php?login=Password successfully reset' />";
                                }
                                catch(PDOException $e){
                                          $_SESSION['error'] = $e->getMessage();
                                          header('location: '.$path);
                                }
                      }
                      else{
                                $_SESSION['error'] = 'Code did not match with user';
                                echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../password_reset.php?code=".$_GET['code']."&user=".$_GET['user']."&login=Code did not match with user' />";
                      }

                      $pdo->close();
            }

}else{
            $_SESSION['error'] = 'Input new password first';
            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../password_reset.php?code=".$_GET['code']."&user=".$_GET['user']."&login=Input new password first' />";
}

