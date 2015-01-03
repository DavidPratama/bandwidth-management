<?php
include "Configuration.php";
include "ConfigurationDriver.php";
include "FileBasedConfiguration.php";
include "FileReadWrite.php";
include "ConfigurationEntity.php";

$conf = new Configuration(new FileBasedConfiguration);

$entity = new ConfigurationEntity;
$entity->add("DOWNLOAD", "1Mbit");
$entity->add("UPLOAD", "22Mbit");

var_dump($conf->all('configuration'));