<!-- 
***************************************This does not work and needs rework **********************************************
 -->

<?php
class SESSION_handler{
public static $gc_maxlifetime;
public static $cookie_lifetime;
function __construct(){
    self::$gc_maxlifetime = ini_get('session.gc_maxlifetime');
    self::$cookie_lifetime = ini_get('session.cookie_lifetime');
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
public function get($session_key){
    if(session_status() == PHP_SESSION_NONE) {
        if(!empty($_SESSION[$session_key])){
            $_SESSION['time_at_last_session'] = time();
            return $_SESSION[$session_key];
        }
    }
    return undefined;
}
public function set($session_key, $session_value){
    if(session_status() == PHP_SESSION_NONE) {
        $_SESSION[$session_key] = $session_value;
        $_SESSION['time_at_last_session'] = time();
        return $_SESSION[$session_key];
    }
    return undefined;
}
public function session_expired(){
    if(
        time() - ((!empty($_SESSION['time_at_last_session']))? $_SESSION['time_at_last_session'] : 0) >= self::$gc_maxlifetime ||
        session_status() == PHP_SESSION_NONE ||
        !isset($_COOKIE[session_name()])
        ){
        return true;
    }
    return false;
}
}
?>

<!-- is_session_expired.php -->

<?php
    $SESSION = new SESSION_handler();
    if($SESSION->session_expired()){
        echo "true";
    }else{
        echo "false";
    }
?>
<!-- AJAX -->

<script type="text/javascript">
    $(document).ready(function(){
        (function(){
            tmp_ = arguments.callee;
            window.setTimeout(function(){
                $.ajax({
                    url:'/php/is_session_expired.php',
                    success: function(session_expired){
                        if(session_expired == "true"){
                            alert("session has expired");
                        }else{
                            console.log('session has not expired');
                        }
                    }
                });
            });
        })();
    })
</script>
