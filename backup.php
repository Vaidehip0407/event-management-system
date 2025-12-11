<?php
$server = "localhost";
$user = "root";
$pass="";
$db ="event";

// Function to backup MySQL database
function backupDatabaseTables($server, $user, $pass, $db, $tables = '*') {
    $link = mysqli_connect($server, $user, $pass, $db);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get all tables
    if ($tables == '*') {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        if ($result) {
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
            mysqli_free_result($result);
        } else {
            mysqli_close($link);
            return false; // Or handle error as needed
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }

    // Loop through tables
    $return = '';
    foreach ($tables as $table) {
        $result = mysqli_query($link, 'SELECT * FROM ' . $table);
        if (!$result) {
            continue; // Skip to the next table if query fails
        }
        $num_fields = mysqli_num_fields($result);

        $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
        $row2_result = mysqli_query($link, 'SHOW CREATE TABLE ' . $table);
        if ($row2_result) {
            $row2 = mysqli_fetch_row($row2_result);
            $return .= "\n\n" . $row2[1] . ";\n\n";
            mysqli_free_result($row2_result);
        } else {
            continue; // Skip to the next table if SHOW CREATE TABLE fails
        }


        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    // Ensure $row[$j] is treated as a string for preg_replace and addslashes
                    $cell_value = isset($row[$j]) ? (string)$row[$j] : '';
                    $cell_value = addslashes($cell_value);
                    $cell_value = preg_replace("/\n/", "\\n", $cell_value);
                    if (isset($row[$j])) {
                        $return .= '"' . $cell_value . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
            mysqli_data_seek($result, 0); // Reset pointer to the beginning of result set for next field (though not strictly necessary here, good practice in general)
        }
        mysqli_free_result($result);
        $return .= "\n\n\n";
    }

    mysqli_close($link);

    // Save backup to file
    $backup_file = $db . '_' . date("Ymd_His") . '.sql';
    $handle = fopen($backup_file, 'w+');
    fwrite($handle, $return);
    fclose($handle);

    return $backup_file;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Backup</title>
</head>
<body>

<h1>Database Backup</h1>

<form method="post">
    <input type="submit" name="backup" value="Backup Database">
</form>

<?php
// Backup the database when the button is clicked
if(isset($_POST['backup'])) {
    $backup_file = backupDatabaseTables($server, $user, $pass, $db);
    if ($backup_file) {
        // Prompt the user to download the backup file
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($backup_file) . "\"");
        readfile($backup_file);

        exit;
    } else {
        echo "<p style='color: red;'>Database backup failed. Please check error logs.</p>";
    }
}
?>

</body>
</html>