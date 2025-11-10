<?php
// templates/emergencyservices_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=emergencyservices_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>servicename</th>
        <th>servicetype</th>
        <th>contactnumber</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Fire Station Central</td>
        <td>Fire</td>
        <td>101</td>
        <td>Station Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
