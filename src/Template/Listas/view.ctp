<?php
    $count = 0;
    $tabindex = 1;
?>

<?= $this->Html->script('listas/listas.js') ?>

<style>
    .excluir-item {
        color: red;
        cursor: pointer;
    }
</style>

<input type="hidden" id="lista-id" value="<?php echo $data['lista']->id ?>">

<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-8">
        <?php

            $indice = count($data['lista']->items);

            echo $this->Form->input('item',[
                'templates'=>[
                    'inputContainer' => '
                        <div class="form-group row">
                            {{content}}
                        </div>
                    '
                ],
                'label' => false,
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'item',
                'tabindex' => $tabindex
            ]);

            ++$tabindex;
        ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-4">
        <button id="add-item" class="'btn btn-primary" tabindex="<?php echo $tabindex; ++$tabindex; ?>">Add</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <?php foreach ($data['listas_filhas'] as $key => $lista): ?>
            <li>
                <?php
                    echo $this->Html->link($lista, [
                        'controller' => 'listas', 'action' => 'view', $data['acesso'] . '/' . $lista
                    ]);
                ?>
            </li>
        <?php endforeach; ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Item </th>
                        <th> Excluir </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['lista']->items as $key => $item): ?>
                        <tr>
                            <td><?php print ++$count ?></td>
                            <td><?php print $item->item ?></td>
                            <td><span class="text-central excluir-item" data-item="<?php print $item->item ?>">Excluir</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
