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
                const $data = JSON.parse(data);
                drawWeather($data);
            },
            error: function (jqXHR){
                $('.container')
                    .html(jqXHR.responseText);
            }
        });
    });

    function drawWeather(data) {
        const Celsius = Math.round(parseFloat(data.main.temp)-273.15);

        document.getElementById('description').innerHTML = data.weather[0].description;
        document.getElementById('temp').innerHTML = Celsius + '&deg;';
        document.getElementById('location').innerHTML = data.name;
    }
});