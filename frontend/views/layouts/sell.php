<?php $this->beginContent('@app/views/layouts/bootstrap.php'); ?> <!-- Делаем наследование от указанного лэйаута-->
    <div class="container">
        <?=$content ?> <!-- В момент наследования то, что генерирует вьюшка и попадает сюда.  Все что тут содержится попадает
        в родительский шаблон bootstrap.php на место content -->
    </div>
<?php $this->endContent(); ?>

