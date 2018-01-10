<script src="./jquery.js"></script>
<script>
    $(function(){
        $('#cmdent').click(function(){
            $.ajax({
                url:'./console.php',
                type:'POST',
                data:{ command:'input', input:$('#input').val(), ip:'<?= $_POST["ip"] ?>', port:'<?= $_POST["port"] ?>', pass:'<?= $_POST["pass"] ?>' },
                success: function(data){
                    $('#consoleblock').html(data);
                }
            });
            cmdinput.value = '';
            return false;
        });

        $('#start').click(function(){
            $.ajax({
                url:'./console.php',
                type:'POST',
                data:{ command:'start', ip:'<?= $_POST["ip"] ?>', port:'<?= $_POST["port"] ?>', pass:'<?= $_POST["pass"] ?>' },
                    success: function(data){
                    $('#consoleblock').html(data);
                }
            });
            return false;
        });

        $('#stop').click(function(){
            $.ajax({
                url:'./console.php',
                type:'POST',
                data:{ command:'stop', ip:'<?= $_POST["ip"] ?>', port:'<?= $_POST["port"] ?>', pass:'<?= $_POST["pass"] ?>' },
                    success: function(data){
                    $('#consoleblock').html(data);
                }
            });
            return false;
        });

    });
    var auto_refresh = setInterval(function() {
        $.ajax({
            url:'./console.php',
            type:'POST',
            data:{ ip:'<?= $_POST["ip"] ?>', port:'<?= $_POST["port"] ?>', pass:'<?= $_POST["pass"] ?>' },
            success: function(data){
                $('#consoleblock').html(data);
            }
        });
    }, 1000);

    function submitenter(e) {
        if(e && e.keyCode == 13) {
            $.ajax({
                url:'./console.php',
                type:'POST',
                data:{ command:'input', input:$('#cmdinput').val(), ip:'<?= $_POST["ip"] ?>', port:'<?= $_POST["port"] ?>', pass:'<?= $_POST["pass"] ?>' },
                success: function(data){
                    $('#consoleblock').html(data);
                }
            });
            cmdinput.value = '';
            return false;
        }
    }

</script>

<div id="buttons">
	<input id="start" class="button" type="submit" name="start" value="Start">
	<input id="stop" class="button" type="submit" name="stop" value="Stop">
</div>
	
<div id="consoleblock">

    <?php include('./console.php'); ?>

</div>

<input id="cmdinput" type="login" name="input" placeholder="Command" onKeyPress="return submitenter(event)">
<input id="cmdent" type="submit" name="submitinput" value="Send">