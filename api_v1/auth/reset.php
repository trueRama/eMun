<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email=:email");
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch();
        if($row['numrows'] > 0){
            //generate code
            $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code=substr(str_shuffle($set), 0, 15);
            try{
                $stmt = $conn->prepare("UPDATE users SET reset_code=:code WHERE id=:id");
                $stmt->execute(['code'=>$code, 'id'=>$row['id']]);				
                $message = "
                          <h2>Password Reset</h2>
                          <p>Your Account:</p>
                          <p>Email: ".$email."</p>
                          <p>Please click the link below to reset your password.</p>
                          <a href='http://localhost/My_doctors/password_reset.php?code=".$code."&user=".$row['id']."'>Reset Password</a>
                ";
                //Load phpmailer
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);                             
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'mail.myplateug.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'customercare@myplateug.com';
                    $mail->Password = '(customerCare669)';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom('customercare@myplateug.com');
                      //Recipients
                      $mail->addAddress($email);              
                      $mail->addReplyTo('myplate.kigozi@gmail.com');
                      //Content
                      $mail->isHTML(true);                                  
                      $mail->Subject = 'My Plate Password Reset';
                      $mail->Body    = $message;
                      $mail->send();
                      $_SESSION['success'] = 'Password reset link sent';
                } 
                catch (Exception $e) {
                      $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                }
            }
              catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }else{
            $_SESSION['error'] = 'Email not found';
        }
        $pdo->close();
    }else{
        $_SESSION['error'] = 'Input email associated with account';
    }
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../REST_PASSWORD.php?login=Check your Email For the Rest code' />";
   //echo $_SESSION['error'];