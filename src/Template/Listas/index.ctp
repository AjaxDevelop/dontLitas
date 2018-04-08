<?php

?>
<div class="listas index large-9 medium-8 columns content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id', '#') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('acesso', 'Lista') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listas as $lista): ?>
                        <tr>
                            <td><?= h($lista->id) ?></td>

                            <td><?php echo $this->Html->link(
                                    h($lista->acesso),
                                    ['controller' => 'listas', 'action' => 'view', $lista->acesso, '_full' => true]
                                ); ?></td>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="paginator" style="color: #3f51b5;">
                <div class="row pagination">
                    <?php
                        $this->Paginator->templates([
                            'current' => '<li class="active"><a style="color: #8c8c8c" href=' . $this->Url->build([
                                    "?" => $this->request->query
                                ]) . '#>{{text}}</a></li>',

                        ]);
                    ?>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-12">
                        <?= $this->Paginator->prev('' . __('Anterior')) ?>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-12 text-center">
                    <?= $this->Paginator->numbers() ?>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-12">
                        <?= $this->Paginator->next(__(' Proximo') . '') ?>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-center"><?= $this->Paginator->counter('{{page}} de {{pages}}') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
