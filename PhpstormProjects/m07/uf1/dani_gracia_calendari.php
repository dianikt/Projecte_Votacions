<?php
    $semana = 0;

	for($i=1;$i<=date('t');$i++) {
        $dia_semana = date('N', strtotime(date('Y-m').'-'.$i));
        $calendario[$semana][$dia_semana] = $i;
        if ($dia_semana == 7) {
            $semana++;
        };
    }
?>
<style>
    table {
        sborder-collapse: collapse;
        width: 100%;
    }

    th{
        font-size: 25px;
    }

    th, td {
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even){
        background-color: #f2f2f2
    }
</style>

<!DOCTYPE html>
<html>
    <head>
        <title>Calendari mes actual</title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>Dilluns</th>
                    <th>Dimarts</th>
                    <th>Dimecres</th>
                    <th>Dijous</th>
                    <th>Divendres</th>
                    <th>Dissabte</th>
                    <th>Diumenge</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calendario as $dias) : ?>
                <tr>
                    <?php for ($i=1;$i<=7;$i++) : ?>
                    <td>
                        <?php echo isset($dias[$i]) ? $dias[$i] : ''; ?>
                    </td>
                    <?php endfor; ?>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>
