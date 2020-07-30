<?php

Route::group(['middleware'=>'verify_session'],function(){

    Route::get('acceso',                    'AutenticationController@index')->name('login');
    Route::post('autenticacion',            'AutenticationController@auth')->name('auth');
    Route::get('recuperar-cuenta',          'AutenticationController@recover_acount')->name('recover_acount');
    Route::post('verificar-correo',         'AutenticationController@verify_email')->name('verify_email');
    Route::get('recuperar-clave/{token}',   'AutenticationController@recover_password')->name('recover_password');
    Route::post('actualizar-clave',         'AutenticationController@update_password')->name('update_password');

});

Route::group(['middleware'=>'authentication'],function(){

    Route::get('/',                             'HomeController@index')->name('home');
    Route::get('mi-informacion',                'SettingsController@profile')->name('profile');
    Route::post('actualizar-datos',             'SettingsController@update_datas')->name('update_datas');
    Route::get('cambiar-foto-perfil',           'SettingsController@photo_profile')->name('photo_profile');
    Route::post('actualizar-foto-perfil',       'SettingsController@update_photo')->name('update_photo_settings');
    Route::get('cambiar-contrasenia',           'SettingsController@reset_password')->name('reset_password');
    Route::post('actualizar-contrasenia',       'SettingsController@update_password')->name('update_password_setting');
    Route::get('obtener-imagen-perfil/{name}',  'UsersController@get_image_profile')->name('image_profile');
    Route::post('salir',                        'AutenticationController@logout')->name('logout');

    Route::get('mostrar-mapa-localidad/{id}',   'MapsController@get_map')->name('map-loc');
    Route::get('info-mapa-localidad',           'MapsController@get_location');
    Route::get('puntos-georeferenciados',       'MapsController@get_points_georeferenced');
    Route::get('puntos-georeferenciados-vibrio','MapsController@get_points_georeferenced_vibrio');
    Route::get('obtener-evidencia/{name}',      'EvidencesController@get_img_evidence')->name('evidence');

    Route::get('obtener-logo/{name}',           'Reports\ExhortosController@get_img_logo')->name('logo');

    Route::resources([
        'usuarios'                      =>  'UsersController',
        'municipios'                    =>  'MunicipalitiesController',
        'jurisdicciones'                =>  'JurisdictionsController',
        'municipios-por-jurisdiccion'   =>  'Munici_x_JurisdController',
        'localidades'                   =>  'LocationsController',
        'roles'                         =>  'RolesController',
        'calendario'                    =>  'CalendarController',
        'cloro-residual'                =>  'ResidualChlorineController',
        'calles-localidad'              =>  'Streets_x_LocationController',
        'evidencias'                    =>  'EvidencesController',
        'vibrio'                        =>  'VibrioCholeraeController',
        'exhortos'                      =>  'ExhortosController',
        'modificacion-cloro-residual'   =>  'Modifications\ResidualChlorineController',
        'modificacion-exhortos'         =>  'Modifications\ExhortosController',
        'modificacion-vibrio-cholerae'  =>  'Modifications\VibrioCholeraeController',
    ]);

    Route::prefix('reporte')->group(function (){

        Route::resources([
            'muestra-bactereologica'            =>  'Reports\BacteriologicalSampleController',
            'determinacion-de-cloro'            =>  'Reports\ChlorineDeterminationController',
            'mensual-municipal'                 =>  'Reports\MunicipalMonthlyController',
            'semanal-jurisdiccional'            =>  'Reports\JurisdictionWeeKlyController',
            'vibrio-cholerae'                   =>  'Reports\VibrioSamplingController',
            'semana-epidemiologica'             =>  'Reports\EpidemilogicalWeekController',
            'exhortos-eficiencia-cloracion'     =>  'Reports\ExhortosController',
        ]);
    });


});

