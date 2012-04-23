<?php 

$xml = new XmlWriter();
$xml->openMemory();
$xml->startDocument('1.0');
$xml->startElement('config');
    $xml->startElement('global');
        $xml->startElement('install');
            $xml->startElement('date');
                $xml->writeCData(date('r'));
            $xml->endElement(); //date
        $xml->endElement(); //install
        $xml->startElement('crypt');
            $xml->startElement('key');
                $xml->writeCData(hash('md5', $_SERVER['APP_NAME']));
            $xml->endElement(); //key
        $xml->endElement(); //crypt
        $xml->startElement('disable_local_modules');
            $xml->writeCData('false');
        $xml->endElement(); // disable_local_modules
        $xml->startElement('resources');
            $xml->startElement('db');
                $xml->startElement('table_prefix');
                    $xml->writeCData('');
                $xml->endElement(); // table_prefix
            $xml->endElement(); // db
            $xml->startElement('default_setup');
                $xml->startElement('connection');
                    $xml->startElement('host');
                        $xml->writeCData($_SERVER['DB1_HOST']);
                    $xml->endElement(); // host
                    $xml->startElement('username');
                        $xml->writeCData($_SERVER['DB1_USER']);
                    $xml->endElement(); // username
                    $xml->startElement('password');
                        $xml->writeCData($_SERVER['DB1_PASS']);
                    $xml->endElement(); // password
                    $xml->startElement('dbname');
                        $xml->writeCData($_SERVER['DB1_NAME']);
                    $xml->endElement(); // dbname
                    $xml->startElement('initStatements');
                        $xml->writeCData('SET NAMES utf8');
                    $xml->endElement(); // initStatements
                    $xml->startElement('model');
                        $xml->writeCData('mysql4');
                    $xml->endElement(); // model
                    $xml->startElement('type');
                        $xml->writeCData('pdo_mysql');
                    $xml->endElement(); // type
                    $xml->startElement('pdoType');
                        $xml->writeCData('');
                    $xml->endElement(); // pdoType
                    $xml->startElement('active');
                        $xml->writeCData('1');
                    $xml->endElement(); // active
                $xml->endElement(); // connection
            $xml->endElement(); // default_setup
        $xml->endElement(); // resources
        $xml->startElement('session_save');
            $xml->writeCData('redis');
        $xml->endElement(); // session_save
        $xml->startElement('session_save_path');
            $xml->writeCData('tcp://' . $_SERVER["CACHE1_HOST"] . ':' . $_SERVER["CACHE1_PORT"]);
        $xml->endElement(); // session_save_path
        $xml->startElement('cache');
            $xml->startElement('backend');
                $xml->text('Cm_Cache_Backend_Redis');
            $xml->endElement(); // backend
            $xml->startElement('backend_options');
                $xml->startElement('server');
                    $xml->text($_SERVER['CACHE1_HOST']);
                $xml->endElement(); // server
                $xml->startElement('port');
                    $xml->text($_SERVER['CACHE1_PORT']);
                $xml->endElement(); // port
                $xml->startElement('database');
                    $xml->text(0);
                $xml->endElement(); // database
                $xml->startElement('force_standalone');
                    $xml->text(0);
                $xml->endElement(); // force_standalone
                $xml->startElement('automatic_cleaning_factor');
                    $xml->text(0);
                $xml->endElement(); // automatic_cleaning_factor
                $xml->startElement('compress_data');
                    $xml->text(1);
                $xml->endElement(); // compress_data
                $xml->startElement('compress_tags');
                    $xml->text(1);
                $xml->endElement(); // compress_tags
                $xml->startElement('compress_threshold');
                    $xml->text(20480);
                $xml->endElement(); // compress_threshold
                $xml->startElement('compression_lib');
                    $xml->text('gzip');
                $xml->endElement(); // compression_lib
            $xml->endElement(); // backend_options
        $xml->endElement(); // cache
    $xml->endElement(); // global
    $xml->startElement('admin');
        $xml->startElement('routers');
            $xml->startElement('adminhtml');
                $xml->startElement('args');
                    $xml->startElement('frontname');
                        $xml->writeCData('admin');
                    $xml->endElement(); //frontname
                $xml->endElement(); //args
            $xml->endElement(); //adminhtml
        $xml->endElement(); //admin
    $xml->endElement(); //admin
$xml->endElement(); //config

$handle = fopen('/var/www/app/etc/local.xml', 'w');
fwrite($handle, $xml->outputMemory(true));
    
?>