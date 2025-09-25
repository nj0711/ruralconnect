<?php
// templates/watersupply_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=watersupply_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>systemdescription</th>
        <th>sourcetype</th>
        <th>sourcedescription</th>
        <th>installationdate</th>
        <th>capacity</th>
        <th>lastmaintenancedate</th>
        <th>systemcondition</th>
        <th>morningstart</th>
        <th>morningend</th>
        <th>afternoonstart</th>
        <th>afternoonend</th>
        <th>eveningstart</th>
        <th>eveningend</th>
        <th>entityname</th>
        <th>entitytype</th>
        <th>contactphone</th>
        <th>contactperson</th>
        <th>address</th>
        <th>fundingsource</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Borewell System</td>
        <td>Borewell</td>
        <td>Deep borewell with pump system</td>
        <td>2022-03-15</td>
        <td>50000</td>
        <td>2023-12-01</td>
        <td>Good</td>
        <td>06:00</td>
        <td>09:00</td>
        <td>12:00</td>
        <td>14:00</td>
        <td>18:00</td>
        <td>20:00</td>
        <td>Village Panchayat</td>
        <td>Government</td>
        <td>9876543210</td>
        <td>Mr. Kumar</td>
        <td>Panchayat Office, Main Road</td>
        <td>Government funding</td>
        <td>off</td>
      </tr>";
echo "</table>";
exit;
