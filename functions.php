<?php

$conn=null;
$user_os='user_token';
if (!defined('IN_SITE')) die ('The request not found');
function db_connect(){
  global $conn;
$server_name='localhost';
$username='root';
$password='';
 $conn= mysqli_connect($server_name,$username,$password,'demo');
 if(mysqli_connect_error())
 {
     die("Connection failed:".$conn->connect_error);
 }
}// ham ket noi db
function db_disconnect(){
  global $conn;
  if($conn){
    $conn->close();
  }
}//ham ngat ket noi db
function db_get_row($sql){
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}//ham lay du lieu 1 row tu db
function db_excute($sql)
{
  db_connect();
  global $conn;
 if(mysqli_query($conn,$sql)){ return mysqli_query($conn,$sql); }
 else {
  die("Error: " . $sql . "<br>" . mysqli_error($conn));
 }
}// ham thu hien xoa chen trong db
function get_user_name()
{
 $user=is_logged();
 return empty($user['name'])?'name':$user['name'];

}//ham lay ten cua user vua dang nhap

function set_logged($name, $level){
    global $user_os;
    session_set($user_os, array(
        'name' => $name,
        'level' => $level
    ));
}// ham set ten va

// Hàm thiết lập đăng xuất
function set_logout(){
    global $user_os;
    session_delete($user_os);
}

// Hàm kiểm tra trạng thái người dùng đã đăng nhập chưa
function is_logged(){
    global $user_os;
    $user = session_get($user_os);
    return $user;
}

// Hàm kiểm tra có phải là admin hay không
function is_admin(){
    $user  = is_logged();
    if (!empty($user['level']) && $user['level'] == '1'){
        return true;
    }
    return false;
}// ham xac nhan admin
function get_ten_books(){
  $sql="select * from ( select * from book order by view ) as a limit 10 ";
  $result= db_excute($sql);
  return $result;
}
?>
