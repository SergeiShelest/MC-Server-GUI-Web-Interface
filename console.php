<?php

    $GLOBALS['ip'] = $_POST['ip'];
    $GLOBALS['port'] = $_POST['port'];
    $GLOBALS['password'] = $_POST['pass'];
    
    include ('php_json_api.php');

    if (isset($_POST['command'])) {
        if ($_POST['command'] == 'input') {
            sendInput($_POST['input']);
        }
        if ($_POST['command'] == 'start') {
            startServer();
        }
        if ($_POST['command'] == 'stop') {
            stopServer();
        }
    }
   
    $response = getOutput(false);

    if(isset($response['Error'])) {
    
        print "Error: " . $response['Error'];
    
        if ($response['Error'] == 'Authentication Error') {
    
            echo "<meta http-equiv='Refresh' content='0;url=index.php?error=badpass' />";
    
        }
    
        if ($response['Error'] == 'E') {
    
            echo "<meta http-equiv='Refresh' content='0;url=index.php?error=baddata' />";
    
        }
    
    }
    else if(isset($response['Success']) or isset($response['Partial Success'])) {
    
        if (isset($response['Data'])) {

            $response['Data'] = str_replace("INFO]", '<span style="color:green">INFO</span>]', $response['Data']);
            $response['Data'] = str_replace("WARN]", '<span style="color:yellow">WARN</span>]', $response['Data']);
            $response['Data'] = str_replace("WARNING]", '<span style="color:yellow">WARNING</span>]', $response['Data']);
            $response['Data'] = str_replace("ERROR]", '<span style="color:orange">ERROR</span>]', $response['Data']);
            $response['Data'] = str_replace("FATAL]", '<span style="color:red">FATAL</span>]', $response['Data']);
            $response['Data'] = str_replace("]", '<span style="color:gray">]</span>', $response['Data']);
            $response['Data'] = str_replace("[", '<span style="color:gray">[</span>', $response['Data']);

            echo $response['Data'];
        
        }
        else {
            echo "Something was wrong with the response";
        }
    }
    else {
        echo $response;
    }
?>
