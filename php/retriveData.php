<?php

$db = new SQLite3("../bin/sanremo_clean.db");

$is_empty = true;

$scelti = $_POST['scelti'];
// var_dump($scelti);
$scelti_dim = sizeof($scelti);
// var_dump($scelti_dim);

$scelti_tmp = array('%','%','%','%','%');

for ($i = 0; $i < $scelti_dim; $i++) {
    $scelti_tmp[$i] = $scelti[$i];
}

// var_dump($scelti_tmp);

$query = $db->prepare("
                    select C1, C2, C3, C4, C5, BAUDI
                    from combinazioni
                    where
                    (
                    C1 like :c1 OR C2 like :c1 OR C3 like :c1 OR C4 like :c1 OR C5 like :c1
                    )
                    and
                    (
                    C1 like :c2 OR C2 like :c2 OR C3 like :c2 OR C4 like :c2 OR C5 like :c2
                    )
                    and
                    (
                        C1 like :c3 OR C2 like :c3 OR C3 like :c3 OR C4 like :c3 OR C5 like :c3
                    )
                    and
                    (
                    C1 like :c4 OR C2 like :c4 OR C3 like :c4 OR C4 like :c4 OR C5 like :c4
                    )
                    and
                    (
                    C1 like :c5 OR C2 like :c5 OR C3 like :c5 OR C4 like :c5 OR C5 like :c5
                    );");

$query->bindParam(':c1', $scelti_tmp[0]);
$query->bindParam(':c2', $scelti_tmp[1]);
$query->bindParam(':c3', $scelti_tmp[2]);
$query->bindParam(':c4', $scelti_tmp[3]);
$query->bindParam(':c5', $scelti_tmp[4]);
$res = $query->execute();

// var_dump($res);
// REGEXP '^(?=.*\bAna_Mena\b)(?=.*\bMahmood_e_Blanco\b).*$';

    echo "
            <table>
                <thead>
                    <tr>
                        <th>Concorrente1</th>
                        <th>Concorrente2</th>
                        <th>Concorrente3</th>
                        <th>Concorrente4</th>
                        <th>Concorrente5</th>
                        <th>BAUDI</th>
                    </tr>
                </thead>
                <tbody>
    ";

    while ($row = $res->fetchArray()) {
        echo "<tr><td>{$row['C1']}</td><td>{$row['C2']}</td><td>{$row['C3']}</td><td>{$row['C4']}</td><td>{$row['C5']}</td><td>{$row['BAUDI']}</td></tr>";
        $is_empty = false;
    }

    if($is_empty){
        echo "<p style='text-align:center; border:1px solid black; font-weight:bold;'>Non ho trovato possibili combinazioni</p>";
    }
    echo "
        </tbody>
    </table>
    ";
    