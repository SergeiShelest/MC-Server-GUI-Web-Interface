<?php

    function startServer() {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Start Server'));
    }

    function stopServer() {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Stop Server'));
    }

    function getOutput($alltags = true) {
        if ($alltags) {
            return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Get Output'));
        } else {
            return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Get Output', 'Data' => array('Line Break Only')));
        }
    }

    function getPlainTextOutput($lineend = 'CRLF') {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Get Output', 'Data' => array('Plain Text', $lineend)));
    }

    function sendInput($input) {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Send Input', 'Data' => array($input)));
    }

    function executeTask($taskname) {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Execute Task', 'Data' => array($taskname)));
    }

    function getTaskNames() {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Get Task Names'));
    }

    function getTaskDetails($taskname) {
        return sendToGui(array('Password' => $GLOBALS['password'], 'Request' => 'Get Task Details', 'Data' => array($taskname)));
    }

    function sendToGui($json) {
        $sock = fsockopen($GLOBALS['ip'], $GLOBALS['port']);
        if ($sock != false) {
            $written = fwrite($sock, json_encode($json));
            if ($written != false) {
                fflush($sock);
                $response = json_decode(fgets($sock), true);
                fclose($sock);
                return $response;
            } else {
                return "Error processing request";
            }
        } else {
            return "Error opening connection";
        }
    }
?>