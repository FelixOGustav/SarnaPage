<!DOCTYPE html>

<html>
<head lang="sv">
        <meta charset="ISO-8859-1">

    <title>{{$mail->subject}}</title>
</head>
<body style="margin: 0px;">
    <div style="font-family:sans-serif; max-width: 800px; margin-left: auto; margin-right: auto;
    padding: 0px 10px;">
    <h1 style="color: #606569; text-align:center;">Branäslägret</h1>
    {!! html_entity_decode($mail->body)!!}        
  
    </div>
    
</body>
</html>