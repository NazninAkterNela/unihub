

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>t-Factor Authentication</title>
    <link rel = "icon" href ="../../assets/icons/logo.png" type = "image/x-icon">
    <link rel="stylesheet" href="otp.css">
</head>
<body>
    <div class="container">
        <h1>Enter OTP</h1>
        
        <form name="form" action="confirmation.php" method="post">
            <div class="userInput">
                <input name='a' type="text" maxlength ="1">
                <input name='b' type="text" maxlength ="1">
                <input name='c' type="text" maxlength ="1">
                <input name='d' type="text" maxlength ="1">
            </div>
            
            <button >Confirm </button>
        </form>
        
       
        
        
    </div>
    <script type ="text/javascript"> 
        function clickEvent(first,last){
            if(first.value.length){
                document.getElementbyId(last).focus();
            }
        }
    </script>
</body>
</html>