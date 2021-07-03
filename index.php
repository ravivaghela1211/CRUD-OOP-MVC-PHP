<?php
require_once ("Model/db.php");
require_once ("Model/operation.php");


$db_handle = new db();
$operation = new operation();
$action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case 'add_student':
        
                if (isset($_POST['insert'])) {
                        $enroll_no = $_POST['enroll_no'];
                        $name = $_POST['name'];
                        $mobile = $_POST['mobile'];
                        $status =$operation->insert($enroll_no, $name, $mobile);
                    }
                require 'View/add_student.php';
                break;

    case 'delete':
                $id=$_GET['id'];
                    $deleteid = $operation->delete($id);
                    header('location:index.php');
                break;
    case 'update':
                    $id=$_GET['id'];
                    $result=$operation->selectOne($id);

                   if (isset($_POST['update'])) {
                        $enroll_no = $_POST['enroll_no'];
                        $name = $_POST['name'];
                        $mobile = $_POST['mobile'];
                        $id=$_POST['id'];
                        $updateop =$operation->update($enroll_no, $name, $mobile,$id);
                    }
                    
                include 'View/update.php';
                break;
    
    default:
        
        $data = $operation->select();
        require_once "view/student.php";
        break;
}
?>