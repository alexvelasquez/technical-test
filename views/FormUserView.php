<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= assets(); ?>/css/forms.css" />
    <title>Document</title>
</head>
<body>
<?php include_once('modules/Header.php') ?>
<?php 
    $user = !empty($data['user']) ? $data['user'] : null;
    $titleButton = $user ? 'Edit' : 'Create';
?>

<a href="<?= base_url()?>/user/home"><button class="button-action button-lg">Back</button></a>
<div class="section-container section-user">
        <div class="alert-notify alert-error" >
            <span id="section-error" style="display: none"></span>
        </div>
        <div class="alert-notify alert-successfully">
            <span id="section-successfully" style="display: none"></span>
        </div>
        <form id="form-user" onsubmit="userSubmit(event);" method="POST">
                <div class="container">
                    <label for="name"><b>Name (*)</b></label>
                    <input type="text" placeholder="Enter name" name="name" value="<?= $user? $user->getName() : '' ?>" required>
                    <label for="last_name"><b>Last name (*)</b></label>
                    <input type="text" placeholder="Enter Last Name" name="last_name" value="<?= $user? $user->getLastName() : '' ?>" required>
                    <label for="username"><b>Username (*)</b></label>
                    <input type="text" placeholder="Enter username" name="username" value="<?= $user? $user->getUsername() : '' ?>" required>
                    <label for="email"><b>Email (*)</b></label>
                    <input type="text" placeholder="Enter email" name="email" value="<?= $user? $user->getEmail() : '' ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="user@domain.com" required>
                    <?php 
                    if(!$user){
                        echo '<label for="password"><b>Password (*)</b></label>';
                        echo '<input type="password" placeholder="Enter password" name="password" value="" required>';
                    }
                    else{
                        echo '<input type="hidden" name="id" value="'.$user->getId().'">';
                    }
                    ?>
                    <button type="submit"><?php echo $titleButton ?></button>
                </div>
        </form>
        <script> const base_url = "<?=base_url(); ?>";</script>
        <script src="<?= assets(); ?>/js/utils.js"></script>
        <script src="<?= assets(); ?>/js/user.js"></script>
    </div>
</body>
</html>