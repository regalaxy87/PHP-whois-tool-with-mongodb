<?php
session_start();

    if ( ($_POST['email'] == "admin@admin.com") && ($_POST['password'] == "admin") ) {

                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    include 'listofusers.php';
    }
            
        elseif (isset($_SESSION['check'])){
                        include 'listofusers.php';                    

            }

            else{

                    die ('wrong pass');
                }
?>

