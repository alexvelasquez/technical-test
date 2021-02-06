<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div style="text-align: right;">
            <h5><?php echo $_SESSION['username']; ?> <a href="<?= base_url();?>/default/logout">Logout</a></h5>
        </div>
        <div style="text-align: center;">
            <h1 id="title-user"><?php echo $data['title'] ?></h1>
        </div>
    </div>
</body>
</html>