<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Guestbook</title>
    <style media="screen">
    .container{
        margin:0 auto;
        width: 400px;
    }
    textarea{
        width: 100%;
    }
    </style>
</head>
<body>
    <div class="container">
        <center>
            <h1>Guestbook</h1>
            <form class="" action="save.php" method="post">
                <label for="">Mensagem</label><br>
                <textarea name="message" rows="8"></textarea><br>
                <button type="submit" name="button">Enviar</button>
            </form>
        </center>
        <?php
        print $messages;
        ?>
    </div>
</body>
</html>
