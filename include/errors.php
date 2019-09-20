<?php if(count($errors) > 0): /*this is used to process the errors//has not been implemented visually yet*/?>
    <div class="error">
        <?php foreach($errors as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div> 
<?php endif ?>

