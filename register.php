<?php include_once('functions.php');?>
<?php
// define variables and set to empty values
$name = $emai=$username=$password= "";
$error=array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!empty($_POST["submit"])){
  if (empty($_POST["name"])) {
    $error['nameErr'] = "name is requiered";
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
         $error['db_insert']=db_excute($sql);
         if(!$error)
         header('location:fuctions.php');
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
<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: red;}
body{
  background-color: #DEB887;
}

form {
  margin:auto;
  border: 3px solid red;
  width: 400px;
  padding: 20px;
  padding-left: 100px !important;
  margin-top:200px;
  background-color: white;
}
</style>
</head>
<body>


<div class="reg">
<form method="post" >
  <h2>form register </h2>

  Name: <input type="text" name="name" value="<?php echo empty($_POST['name'])?'':$_POST['name'];?>">
  <span class="error">* <?php echo empty($error['nameErr'])?'':$error['nameErr'];?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo  empty($_POST['email'])?'':$_POST['email'];?>">
  <span class="error">* <?php echo empty($error['emailErr'])?'':$error['emailErr'];?></span>
  <br><br>
  username: <input type="text" name="username" value="<?php echo empty($_POST['username'])?'':$_POST['username'];?>">
  <span class="error">*<?php echo empty($error['usernameErr'])?'':$error['usernameErr'] ;?></span>
  <br><br>
  password: <input type="password" name="password" value="<?php echo  empty($_POST['password'])?'':$_POST['password'];?>">
  <span class="error">*<?php echo empty($error['passwordErr'])?'':$error['passwordErr'];?></span>
  <br><br>
  <?php echo empty($error['db_insert'])?'':$error['db_insert'];?>
  <input type="submit" name="submit" value="DANG KI">
</form>
</div><!--end register-->
</body>
</html>
