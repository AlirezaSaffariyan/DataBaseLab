<?php
function printTable($result, $tableName) {
    // column info
    $fields = $result->fetch_fields();

    $tableMainStyle = 'style="border-collapse: collapse; margin: 5px;"';
    $tableBorderStyle = 'style="border: solid; padding: 5px; text-align: center;"';

    // start of HTML table
    echo "<table $tableMainStyle>";
    echo '<caption style="font-size: 25px; font-weight: bold; margin-bottom: 3px;">' .
        $tableName . "</caption>";
    // column names (table header)
    echo "<tr $tableBorderStyle>";
    foreach ($fields as $field) {
        echo "<th $tableBorderStyle>" . $field->name . "</th>";
    }
    echo "</tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // start of HTML tr (table row)
            echo "<tr $tableBorderStyle>";

            foreach ($fields as $field) {
                echo "<td $tableBorderStyle>" . $row[$field->name] . "</td>";
            }

            // end of HTML tr (table row)
            echo "</tr>";
        }
    } else {
        echo "<tr><td $tableBorderStyle colspan='" . count($fields) . "'>No result found.</td></tr>";
    }

    // end of HTML table
    echo "</table>";
}