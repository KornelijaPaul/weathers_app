$(document).ready(() => {
    const $tabContainer = document.getElementById('city-tabs');
    const $container = $('.container');
    const $formWrapper = $container.find('.form-wrapper');

    let cities = [];

    $formWrapper.on('submit', function (event) {
        event.preventDefault();
        const $form = $(event.currentTarget)[0];

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

                if (!cities.includes($data.name)){
                    cities.push($data.name);
                    drawWeather($data);
                }
            },
            error: function (jqXHR){
                $('.container')
                    .html(jqXHR.responseText);
            }
        });
    });

    function drawWeather(data) {
        const Celsius = Math.round(parseFloat(data.main.temp)-273.15) + '&deg;';
        const CelsiusFeelsLike = Math.round(parseFloat(data.main.feels_like)-273.15) + '&deg;';
        const description = data.weather[0].description;
        const name = data.name;
        const humidity = data.main.humidity + '%';

        document.getElementsByClassName('city-list')[0].insertAdjacentHTML('beforeend', `
         <li class="btn btn-lg btn-success ml-3 mt-3">
                <a id="city-name" data-toggle="pill" href="#${name}" class="text-light">${name}</a>
            </li>
        `);

        document.getElementsByClassName('info')[0].insertAdjacentHTML('afterbegin',`
        <div id="${name}" class="tab-pane ml-5 text-center">
                <div class="card mx-auto text-white bg-dark mb-3" style="width: 500px;">
                    <div id="description" class="card-header font-weight-bold">${name}</div>
                    <div class="card-body">
                        <h3 id="humidity" class="card-text">${description}</h3>
                        <h1 id="temp" class="card-text text-secondary font-weight-bold ml-2">${Celsius}</h1>
                        <div id="feels-like" class="card-text">Feels like ${CelsiusFeelsLike}</div>
                        <div id="humidity" class="card-text">Humidity ${humidity}</div>
                    </div>
                </div>
            </div>
        `);

        $tabContainer.classList.remove("d-none");
    }
});