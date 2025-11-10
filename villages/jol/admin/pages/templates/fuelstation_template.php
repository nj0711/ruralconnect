<?php
// templates/fuelstation_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=fuelstation_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>fuelstationname</th>
        <th>photo</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>contactno</th>
        <th>pumpstimeduration</th>
        <th>typesoffuelavailable</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Petrol Pump</td>
        <td>[]</td>
        <td>Main Highway</td>
        <td>Anand</td>
        <td>388001</td>
        <td>9876543210</td>
        <td>{&quot;open&quot;:&quot;06:00&quot;,&quot;close&quot;:&quot;22:00&quot;}</td>
        <td>petrol,diesel</td>
        <td>24/7 fuel station with convenience store</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
