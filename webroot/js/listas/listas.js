$(document).ready(function(){

    $('body').on('click', '#add-item', function()
    {
        var id = $('#lista-id').val(),
            item = $('#item').val(),
            action = 'add';

        update(id, item, action);
    });

    $('body').on('click', '.excluir-item', function()
    {
        var id = $('#lista-id').val(),
            item = $this.attr('data-item'),
            action = 'dekete';

        update(id, item, action);
    });

    var update = function(id, item, action) {
        var dados = {
            id: id,
            item: item,
            action: action
        };

        $.ajax({
            url: "localhost/dontListas/items/edit.json",
            method: 'POST',
            data: dados,
            success: function (resposta) {
                window.location.reload();
            }
        });
    }

});
