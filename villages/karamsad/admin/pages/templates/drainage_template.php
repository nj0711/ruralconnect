<?php
// templates/drainage_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=drainage_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>systemcondition</th>
        <th>lastmaintenancedate</th>
        <th>capacity</th>
        <th>type</th>
        <th>coveragearea</th>
        <th>issuesreported</th>
        <th>maintenancehistory</th>
        <th>entityname</th>
        <th>entitytype</th>
        <th>primarycontactperson</th>
        <th>phoneno</th>
        <th>address</th>
        <th>fundingsource</th>
        <th>establisheddate</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Good</td>
        <td>2024-01-15</td>
        <td>150.50</td>
        <td>Open Drain</td>
        <td>2500.00</td>
        <td>Blockages during monsoon</td>
        <td>Cleaned quarterly</td>
        <td>Village Panchayat</td>
        <td>Government</td>
        <td>Ramesh Kumar</td>
        <td>9876543210</td>
        <td>Main Road, Village XYZ</td>
        <td>Government Grant</td>
        <td>2020-03-10</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
