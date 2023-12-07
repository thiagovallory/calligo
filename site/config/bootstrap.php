<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/*
 * Configure paths required to find CakePHP + general filepath constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ConsoleErrorHandler;
use Cake\Error\ErrorHandler;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Cake\Utility\Security;

/*
 * See https://github.com/josegonzalez/php-dotenv for API details.
 *
 * Uncomment block of code below if you want to use `.env` file during development.
 * You should copy `config/.env.example` to `config/.env` and set/modify the
 * variables as required.
 *
 * The purpose of the .env file is to emulate the presence of the environment
 * variables like they would be present in production.
 *
 * If you use .env files, be careful to not commit them to source control to avoid
 * security risks. See https://github.com/josegonzalez/php-dotenv#general-security-information
 * for more information for recommended practices.
*/
// if (!env('APP_NAME') && file_exists(CONFIG . '.env')) {
//     $dotenv = new \josegonzalez\Dotenv\Loader([CONFIG . '.env']);
//     $dotenv->parse()
//         ->putenv()
//         ->toEnv()
//         ->toServer();
// }

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file to provide overrides to your configuration.
 * Notice: For security reasons app_local.php **should not** be included in your git repo.
 */
if (file_exists(CONFIG . 'app_local.php')) {
    Configure::load('app_local', 'default');
}

/*
 * When debug = true the metadata cache should only last
 * for a short time.
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
    // disable router cache during development
    Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

/*
 * Set the default server timezone. Using UTC makes time calculations / conversions easier.
 * Check http://php.net/manual/en/timezones.php for list of valid timezone strings.
 */
date_default_timezone_set(Configure::read('App.defaultTimezone'));

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 */
$fullBaseUrl = Configure::read('App.fullBaseUrl');
if (!$fullBaseUrl) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        $fullBaseUrl = 'http' . $s . '://' . $httpHost;
    }
    unset($httpHost, $s);
}
if ($fullBaseUrl) {
    Router::fullBaseUrl($fullBaseUrl);
}
unset($fullBaseUrl);

Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
TransportFactory::setConfig(Configure::consume('EmailTransport'));
Mailer::setConfig(Configure::consume('Email'));
Log::setConfig(Configure::consume('Log'));
Security::setSalt(Configure::consume('Security.salt'));

/*
 * Setup detectors for mobile and tablet.
 */
ServerRequest::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
ServerRequest::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * You can set whether the ORM uses immutable or mutable Time types.
 * The default changed in 4.0 to immutable types. You can uncomment
 * below to switch back to mutable types.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link https://book.cakephp.org/4/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
// TypeFactory::build('time')
//    ->useMutable();
// TypeFactory::build('date')
//    ->useMutable();
// TypeFactory::build('datetime')
//    ->useMutable();
// TypeFactory::build('timestamp')
//    ->useMutable();
// TypeFactory::build('datetimefractional')
//    ->useMutable();
// TypeFactory::build('timestampfractional')
//    ->useMutable();
// TypeFactory::build('datetimetimezone')
//    ->useMutable();
// TypeFactory::build('timestamptimezone')
//    ->useMutable();

/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);

Configure::write('GENDERS', [
    2 => 'Feminino',
    1 => 'Masculino',
    3 => 'Não binário'
]);

Configure::write('PRONOUNS', [
    2 => 'Ela',
    1 => 'Ele',
]);

Configure::write('LANGUAGES', [
    1 => 'Port',
    2 => 'Eng',
]);

Configure::write('TIME_ZONES', [
    '' => '',
    1  => '(GMT-3) Brasília',
]);

Configure::write('BANKS_TYPES', [
    1 => 'Conta Corrente',
    2 => 'Conta Poupança',
]);

Configure::write('ACADEMIC_BACKGROUNDS_TYPES', [
    1 => 'Graduação',
    2 => 'Pós Graduação',
    3 => 'Mestrado',
    4 => 'Doutorado'
]);

Configure::write('ACADEMIC_BACKGROUNDS_STATUS', [
    1 => 'Em andamento',
    2 => 'Concluído',
]);

Configure::write('REASONS', [
    1 => 'Motivo 1',
    2 => 'Motivo 2',
]);

Configure::write('DAYS_NAME', [
    0 => 'mon',
    1 => 'tue',
    2 => 'wed',
    3 => 'thu',
    4 => 'fri',
    5 => 'sat',
    6 => 'sun',
]);

Configure::write('DAYS_NAME_PORT', [
    0 => 'SEG',
    1 => 'TER',
    2 => 'QUA',
    3 => 'QUI',
    4 => 'SEX',
    5 => 'SÁB',
    6 => 'DOM',
]);

Configure::write('MONTHS_PORT', [
    1  => 'Janeiro',
    2  => 'Fevereiro',
    3  => 'Março',
    4  => 'Abril',
    5  => 'Maio',
    6  => 'Junho',
    7  => 'Julho',
    8  => 'Agosto',
    9  => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
]);

Configure::write('APPOINTMENTS_STATUS', [
    1 => 'Agendada',
    2 => 'Aguardando Psicólogo',
    3 => 'Em andamento',
    4 => 'Aguardando pagamento',
    5 => 'Finalizada',
    6 => 'Cancelada',
    7 => 'Não compareceu',
]);

Configure::write('BONDS_STATUS', [
    1 => 'Pendente',
    2 => 'Ativo',
    3 => 'Encerrado',
]);

Configure::write('ROLES', [
    1 => 'Paciente',
    2 => 'Terapeuta',
    3 => 'Admin',
]);

Configure::write('CRP_ORIGINS', [
    1 => 'Acre',
    2 => 'Alagoas',
    3 => 'Amapá',
    4 => 'Amazonas',
    5 => 'Bahia',
    6 => 'Ceará',
    7 => 'Espírito Santo',
    8 => 'Goiás',
    9 => 'Maranhão',
    10 => 'Mato Grosso',
    11 => 'Mato Grosso do Sul',
    12 => 'Minas Gerais',
    13 => 'Pará',
    14 => 'Paraíba',
    15 => 'Paraná',
    16 => 'Pernambuco',
    17 => 'Piauí',
    18 => 'Rio de Janeiro',
    19 => 'Rio Grande do Norte',
    20 => 'Rio Grande do Sul',
    21 => 'Rondônia',
    22 => 'Roraima',
    23 => 'Santa Catarina',
    24 => 'São Paulo',
    25 => 'Sergipe',
    26 => 'Tocantins',
    27 => 'Distrito Federal',
]);


Configure::write('SERVER_PHOTOS', Router::url('/', true));
Configure::write('SERVER_VIDEOS', Router::url('/', true));

Configure::write('NO_PHOTO', 'img/nophoto.png');
Configure::write('NO_VIDEO', 'img/novideo.png');

Configure::write('IUGU_TOKEN', '27E4BC806D08C5052BEFE25152B29B22716EA2F9BE51FD4A34B86979DB20D297');
Configure::write('IUGU_TOKEN_SANDBOX', '481BD3A0BDCEE1D51AB759E765A80F5D0A1855201334120CAD390A2EC359ADBB');
Configure::write('IUGU_ID', 'A9ADA0F3C9E64F8AB4439BBA014A9CD7');
Configure::write('IUGU_WEBHOOKS_TOKEN', '8B0A0FE919884452A900569E9BB7CF45');

Configure::write('SESSION_TYPE', [
    1 => [
        'id'       => 'attendance_by_phone_call',
        'name'     => 'Áudio',
        'selected' => false
    ],
    2 => [
        'id'       => 'attendance_by_video_call',
        'name'     => 'Vídeo',
        'selected' => false
    ],
]);

Configure::write('TIME_OF_DEADLINE_FOR_SEARCH', '+30 days');
Configure::write('FOLDER_TOKENS_GOOGLE', ROOT . DS . 'tokens_google' . DS);
Configure::write('FOLDER_DOCS', ROOT . DS . 'uploads_docs' . DS);
Configure::write('EMAILS', [
    'compaint'=>'psicologia@calligo.com.br', //TODO psicologia@calligo.com.br
]);
Configure::write('MAILER', 'Sendgrid'); // TODO Em PROD mudar valor para 'Sendgrid'
Configure::write('TIME_ALLOWED_FOR_APPOINTMENT_PAYMENT', '+15 minutes');
