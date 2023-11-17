<?php if(isset($messages) && count($messages)):?>
    <ul class="alert alert-success" style="margin-top:1em;background:none">
        <?php foreach($messages as $message):?>
        <li class="text-success"><?=$message?></li>	
        <?php endforeach;?>
    </ul>
<?php endif;?>

<?php if(isset($_SESSION['errors']) && count($_SESSION['errors'])):?>
    <ul class="alert alert-danger" style="margin-top:1em;background:none">
        <?php foreach($_SESSION['errors'] as $message):?>
        <li class="text-danger"><?=$message?></li>	
        <?php endforeach;?>
    </ul>
<?php endif;?>
