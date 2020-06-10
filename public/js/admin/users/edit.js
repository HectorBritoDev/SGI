$(function () {

    $('#select_project').on('change', onSelectProjectChange)

})

function onSelectProjectChange() {

    var project_id = $(this).val()
    if (!project_id) {
        $('#select_level').html('<option value="">Seleccione Nivel</option>')
        return;
    }

    //AJAX
    $.get('/api/proyectos/' + project_id + '/niveles', function (data) {
        var html_select = '<option value="">Seleccione Nivel</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].id + '">' + data[i].name + '</option>'
        $('#select_level').html(html_select)
    })
}
