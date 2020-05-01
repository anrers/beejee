<?php include ROOT . '/lay/header.php'; ?>
<div style="margin: 10px;" class="col-xs-12">
    <div class="col-xs-2">Имя <br>
        <a href="/sort/name_DESC">по убыванию</a> <br>
        <a href="/sort/name_ASC">по возрастанию</a>
    </div>
    <div class="col-xs-2">Е-mail <br>
        <a href="/sort/email_DESC">по убыванию</a> <br>
        <a href="/sort/email_ASC">по возрастанию</a>
    </div>
    <div class="col-xs-3">Задача</div>
    <div class="col-xs-2">Статус <br>
        <a href="/sort/checked_DESC">по убыванию</a> <br>
        <a href="/sort/checked_ASC">по возрастанию</a>
    </div>
</div>
<div id='sort-order'>
    <? foreach ($task as $value):?>
        <div style="border: 1px solid black; margin: 10px;" class="col-xs-12">
            <div class="col-xs-2"><?=$value['name']?></div>
            <div class="col-xs-2"><?=$value['email']?></div>
            <div class="col-xs-3"><?=htmlentities($value['task'])?></div>
            <div class="col-xs-2"><?if($value['checked'] == 1) echo 'Выполнена'; else echo 'Не выполнена';?><br>
                                  <?if($value['edit'] == 1) echo 'Отредактирована администратором';?>
            </div>
            <? if (isset($_SESSION['user'])):?>
            <div class="col-xs-2"><a href="/change/<?=$value['id']?>">Изменить</a></div>
            <?endif;?>
        </div>
    <? endforeach;?>
</div>
<div class="col-xs-12">
<?php echo $pagination->get(); ?>
</div>
<div class="col-xs-12">
    <input type='button' id='btn_add' name="add" value="Добавить задачу">
</div>
<div id='add_form' style="display: none">
    <div class="col-xs-12" id="result_form"></div>
    <form id='ajax_form'>
        <div class="col-xs-12">
        Имя <input type='text' name='name'>
        E-mail <input type='text' name='email'>
        </div>
        <div class="col-xs-12">
            Задача <textarea name="task" cols='40' rows="10"></textarea>
            <div>
                <input class="input" type="submit" id="btn" name="submit" value="Добавить" />
            </div>     
        </div>
    </form>
</div>
<?php include ROOT . '/lay/footer.php'; ?>