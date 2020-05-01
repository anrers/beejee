<?php include ROOT . '/lay/header.php'; ?>
<div>
    <div class="col-xs-12">
        <div class="col-xs-3">Имя</div>
        <div class="col-xs-3">Е-mail</div>
        <div class="col-xs-3">Задача</div>
        <div class="col-xs-3">Выполнена</div>
    </div>
    <div class="col-xs-12">
        <div class="col-xs-3"><?=$task['name']?></div>
        <div class="col-xs-3"><?=$task['email']?></div>
        <form method="post" action="/change/update/<?=$task['id']?>">
            <textarea class="col-xs-3" name="task" cols='40' rows="10"><?=$task['task']?></textarea> 
            <input class="col-xs-3" type="checkbox" <?if ($task['checked'] == 1):?>checked<?endif;?> name='checked'>
            <input class="col-xs-12" type='submit' value='Сохранить' name='submit'>   
        </form>
    </div>
</div>
<?php include ROOT . '/lay/footer.php'; ?>