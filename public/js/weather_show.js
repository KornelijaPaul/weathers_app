$(document).ready(() => {
    const $container = $('.container');
    const $formWrapper = $container.find('.form-wrapper');
    console.log($formWrapper);

    $formWrapper.on('submit', function (event) {
        event.preventDefault();
        const $form = $(event.currentTarget)[0];
        console.log($form);

        $.ajax({
            url: '/',
            type: 'POST',
            dataType: 'json',
            data: new FormData($form),
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
             console.log(data.message);
            },
            error: function (jqXHR){
                $('.container')
                    .html(jqXHR.responseText);
            }
        });
    });
});