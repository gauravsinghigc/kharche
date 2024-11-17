<?php
//INsert new data
function INSERT($tablename, array  $RequestedData, $die = false)
{
    $TableValues = "";
    $Datatables = "";

    $table_columns = array_keys($RequestedData);
    $arraycount = count($table_columns);
    $mainarray = $arraycount - 1;
    $countkeys = 0;

    //echo "<br><b style='color:green;'>• REQUESTING </b> -> <b>[$tablename]</b> ---- <b style='color:green;'>Sent!</b> <br><b style='color:red'><i> Data Received</i></b> <b>[$tablename]</b> @ [<br>";
    foreach ($RequestedData as $key => $data) {
        $countkeys++;
        $$data = $data;
        global $$data;
        //echo "&nbsp;&nbsp; <b style='color:grey;'> Index:</b> $countkeys ( <b> " . $key . "</b> : " . $data . " ) <br>";

        if ($countkeys <= $mainarray) {
            $TableValues .= "'" . htmlentities($data) . "', ";
        } else {
            $TableValues .= "'" . htmlentities($data) . "' ";
        }

        if ($countkeys <= $mainarray) {
            $Datatables .= "$key, ";
        } else {
            $Datatables .= "$key ";
        }
    }

    //echo "]<br> ---<b style='color:primary;'>END</b><br><hr>---";


    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";
    GENERATE_APP_LOGS("INSERT_QUERY", "$InsertNewData", "INSERT");
    //die entry
    if ($die == true) {
        die($InsertNewData);
    }
    $Query = mysqli_query(DBConnection, $InsertNewData);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}
