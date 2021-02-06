<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= assets();?>/css/forms.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets();?>/css/users.css" />
    <title>Technical test</title>
</head>

<body>
    <div class="container">
        <?php include_once('modules/Header.php') ?>
        <?php 
            $userSession = $_SESSION['id'];
        ?>
        <table>
            <a href="<?= base_url()?>/user/new"><button class="button-action button-lg">Add user</button></a>
            <div class="alert-notify alert-error" >
                <span id="section-error" style="display: none"></span>
            </div>
            <div class="alert-notify alert-successfully">
                <span id="section-successfully" style="display: none"></span>
            </div>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
            <?php
            $tr = '';
            foreach ($data['users'] as $key => $value) {
                $tr.='<tr id="user-'.$value->getId().'">';
                $tr.='<td >'.strtoupper($value->getName()).'</td>';
                $tr.='<td>'. strtoupper($value->getLastName()).'</td>';
                $tr.='<td>'.$value->getUsername().'</td>';
                $tr.='<td>'.$value->getEmail().'</td>';
                $tr.='<td>'.$value->getCreatedAt().'</td>';
                $tr.='<td>'.$value->getUpdatedAt().'</td>';
                $tr.='<td>';
                $tr.='<a href="'.base_url().'/user/edit/'.$value->getId().'" ><button class="button-action button-md button-edit">Edit</button></a>';
                if($value->getId() !== $userSession){
                    $tr.='<button onClick="userDelete('.$value->getId().',event)" class="button-action button-md button-delete">Delete</button>';
                }
                $tr.='</td>';
                $tr.='</tr>';
            } 
            echo $tr
            ?>
            <script> const base_url = "<?=base_url(); ?>";</script>
            <script src="<?= assets(); ?>/js/utils.js"></script>
            <script src="<?= assets(); ?>/js/user.js"></script>
        </table>
    </div>
</body>

</html>