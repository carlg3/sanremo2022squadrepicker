<?php

$db = new SQLite3('sanremo.db');

$res = $db->query('SELECT * FROM combinazioni');

while ($row = $res->fetchArray()) {
    echo "{$row['squadra']} {$row['baudi']} \n";
}