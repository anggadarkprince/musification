<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/app.php';
require __DIR__ . '/../support/helper.php';

if (PHP_SAPI != 'cli') {
    die('Migration only allowed to be executed in CLI mode');
}

// initiating database module
$db = new \App\Database();
$connection = $db::getConnection();
$connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
echo 'Initiating migration' . newLine();

// get migration table ready
$check = $connection->query('SHOW TABLES LIKE "migrations"');
if ($check->num_rows == 0) {
    $connection->query("
        CREATE TABLE migrations (
          version varchar(100) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");
    $connection->query("
        INSERT INTO migrations (version) VALUES (0)
    ");
    echo 'New migration table' . newLine();
}

// check migration version
$migrationVersion = $connection->query("SELECT version FROM migrations LIMIT 1");
if ($migrationVersion->num_rows) {
    $lastVersion = $migrationVersion->fetch_assoc()['version'];
} else {
    $lastVersion = 0;
}
echo 'Last version of migration is ' . $lastVersion . newLine();

// run migration
$files = scandir(__DIR__);
foreach ($files as $file) {
    if (preg_match("/^[0-9]+/", $file, $version)) {
        if ($version[0] > $lastVersion) {
            $sql = file_get_contents($file);
            if ($connection->query($sql)) {
                $connection->query("UPDATE migrations SET version = '{$version[0]}'");
                $lastVersion = $version[0];
                echo 'Migrate file ' . $file . newLine();
            } else {
                $connection->rollback();
            }
        }
    }
}
$connection->commit();

echo 'Migration complete' . newLine();