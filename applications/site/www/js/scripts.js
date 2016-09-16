/**
 * Prepare files before upload them
 * @param event
 */
function prepareUploadFile(event){
    var input = $(this),
        form = input.parents('form'),
        button_submit = form.find('button[type=submit]'),
        loader = form.find('.s-loader.file-loader'),
        file_list = $('.file-list');

    input.prop('disabled', true);
    button_submit.checks('disable', 'Files are opening');
    loader.show();

    // Files.addList(event.target.files);
    Files.addList(event.target.files, function(reader, file, index){
        var is_end = (index == event.target.files.length);
        if(is_end){
            input.prop('disabled', false);
            button_submit.checks('enable');
            button_submit.checks('revert_text', 1);
            loader.hide();
        }

        file_list.append('<div>' + file.name + '</div>');
    });
}

$(document).ready(function(){

    var form = $('#form');

    form.on('beforeSubmit', function(e){
        e.preventDefault();

        var form = $(this),
            button_submit = form.find('button[type=submit]'),
            loader = form.find('.s-loader.file-loader'),
            data = new FormData(this),
            file_list = $('.file-list');

        // Append files to form data
        $.each(Files.get(), function(name, file){
            data.append(name, file);
        });

        // Disable submit button and enable loader
        button_submit.checks('disable', 'Saving...');
        loader.show();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(){
                // Enable submot button
                button_submit.removeClass('btn-danger');
                button_submit.checks('enable', 'Saved');
                button_submit.checks('revert_text', 1000);

                file_list.html(''); // Clear uploaded files
            },
            error: function(){
                button_submit.checks('enable', 'Server error');
                button_submit.addClass('btn-danger');
            },
            complete: function(){
                // Reset form
                form.get(0).reset();
                files = [];
                loader.hide();
            }
        });

        return false;
    });

    form.on('change', '#file-files', prepareUploadFile);

});