 <?php if (session_status()=== PHP_SESSION_NONE){
    session_start();
 
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        header("Location: user/login");
        exit;
    }}