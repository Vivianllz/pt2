<?php
try {
    $pdo = new PDO("mysql:host=lrgs.ftsm.ukm.my;dbname=a215514", "a215514", "tinyyellowdog");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach (['tbl_orders_a215514', 'tbl_orders_details_a215514'] as $t) {
        echo "=== $t ===\n";
        $cols = $pdo->query("SHOW COLUMNS FROM `$t`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $c) {
            echo $c['Field'] . " | " . $c['Type'] . " | Null=" . $c['Null'] . " | Key=" . $c['Key'] . " | Extra=" . $c['Extra'] . "\n";
        }
        echo "\n-- sample rows --\n";
        $rows = $pdo->query("SELECT * FROM `$t` LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);
    }
} catch (PDOException $e) {
    echo "ERR: " . $e->getMessage() . "\n";
}
