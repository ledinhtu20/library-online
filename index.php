
<?php 

  define("IN_SITE", true);
    include_once('functions.php');
    include_once('session.php');
    include_once('logout.php');
?>
<?php
   $name='';
   if(!empty($_POST['login']))
  { $error1=array();
    $username=addslashes($_POST['username1']);
    $password=addslashes($_POST['password']);
      if(empty($username))
      {
        $error1['username']='ban chua nhap username';
      }

    if(empty($password))
    {
      $error1['password']='ban chua nhap password';
    }

   $username=trim($username);
   $password=trim($password);



   if(empty($error1))
   {

     $sql="select * from member where username='{$username}'";
     $result=db_get_row($sql);
     if(empty($result)||$result['password']!==md5($password)) $error1['account']='sai tai khoan dang nhap. Ban hay thu lai.';
     if(empty($error1)){
      set_logged($result['name'],$result['level']);
        header('location:main.php');
     }
   }
 }
 ?>
 <?php
 // define variables and set to empty values
 $name = $emai=$username=$password= "";
 $error=array();
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if(!empty($_POST["submit"])){
   if (empty($_POST["name"])) {
     $error['nameErr'] = "name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $error['nameErr'] = "Only letters and white space allowed";
     }
   }

   if (empty($_POST["email"])) {
   $error['emailErr'] = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error['emailErr'] = "Invalid email format";
       }
     $sql="select email from member where email='{$email}'";
     $result= db_get_row($sql);
     if($result)
     $error['emailErr']="This email is already exist!";
     }
   if(empty($_POST["username"])){
     $error['usernameErr'] = "Username is required";
   }
   else {
     $username=test_input($_POST["username"]);
     $sql="select username from member where username='{$username}'";
     $result= db_get_row($sql);
     if($result)
     $error['usernameErr']="This username is already exist!";
     }

     if(empty($_POST["password"])){
       $error['passwordErr'] = "Password is required";
     }
     else {
       $password=md5(test_input($_POST["password"]));
       }
   if(!$error)
       {
          $sql="INSERT INTO member (name,username,password,email,level) VALUES ('$name','$username','$password','$email',0)";
          db_excute($sql);
          set_logged($name,0);
          header('location:main.php');

       }
   }
 }
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
     }

 ?>
<!DOCTYPE html>
<html>
<body>
<head>
  <meta charset="utf-8">
  <title>Dang nhap</title>
  <style>
    .reg,.login{
      margin: auto;
      width:400px;
      border: 3px solid black;
      padding: 20px;
      padding-left: 70px !important;
      background-color: white;
    }
    .login{
      border-bottom: none !important;
    }
    .error{
      color: red;
    }
    body{
      background-color: grey;
    }
    input{

    }
  </style>
</head>

      <h2> Chao ban den voi thu vien sach online DHBK Da Nang </h2>
    <div class="login">
      <form method="post" >
        <h2>Login</h2>
          <?php echo !empty($error1['account'])?$error1['account']:'';?><br>
          <input type="text" name="username1" value="<?php echo empty($_POST['username1'])?'':$_POST['username1'];?>" placeholder="username">
          <span class="error1"><?php echo !empty($error1['username'])?$error1['username']:'';?></span><br>
          <input type="password" name="password"  placeholder="password">
          <span class="error1"><?php echo !empty($error1['password'])?$error1['password']:'';?></span><br>
          <input type="submit" name="login" value="dang nhap">
      </form>
    </div><!--end login-->


    <div class="reg">
    <form method="post" >
      <h2>form register </h2>
      <table>
        <tr>
      <td>Name:</td>
       <td><input type="text" name="name" value="<?php echo empty($_POST['name'])?'':$_POST['name'];?>">
      <span class="error">* <?php echo empty($error['nameErr'])?'':$error['nameErr'];?></span>
    </td>
  </tr>
    <tr>
      <td>E-mail:</td>
      <td> <input type="email" name="email" value="<?php echo  empty($_POST['email'])?'':$_POST['email'];?>">
      <span class="error">* <?php echo empty($error['emailErr'])?'':$error['emailErr'];?></span>
    </td>
    </tr>
      <tr><td>username:</td><td> <input type="text" name="username" value="<?php echo empty($_POST['username'])?'':$_POST['username'];?>">
      <span class="error">*<?php echo empty($error['usernameErr'])?'':$error['usernameErr'] ;?></span>
    </td></tr>
      <tr><td>password:</td><td> <input type="password" name="password" >
      <span class="error">*<?php echo empty($error['passwordErr'])?'':$error['passwordErr'];?></span>
    </td></tr>
      <?php echo empty($error['db_insert'])?'':$error['db_insert'];?>
    </table>
      <input type="submit" name="submit" value="DANG KI">
    </form>
    </div><!--end register-->
    </body>
</html>
