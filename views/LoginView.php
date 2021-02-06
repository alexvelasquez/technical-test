<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= assets(); ?>/css/forms.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Technical test</title>
</head>
<body>
    <div class="section-container section-login">
    <div class="alert-notify alert-error" >
            <span id="section-error" style="display: none"></span>
        </div>
        <form id="form-login" onsubmit="login(event);" method="post">
                <div class="container">
                    <label for="username"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username">

                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>

                    <button type="submit">Login</button>
                </div>
        </form>
        <script> const base_url = "<?=base_url(); ?>";</script>
        <script src="<?= assets(); ?>/js/utils.js"></script>
        <script  src="<?= assets(); ?>/js/login.js"></script>
    </div>
</body>
</html>