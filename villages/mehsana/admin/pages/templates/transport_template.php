<?php
// templates/transport_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=transport_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>stationname</th>
        <th>stationtype</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>contactno</th>
        <th>email</th>
        <th>ticketingprocess</th>
        <th>photo</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Central Station</td>
        <td>BusStation</td>
        <td>Main Road, Village Center</td>
        <td>Sample Village</td>
        <td>123456</td>
        <td>9876543210</td>
        <td>station@village.com</td>
        <td>online</td>
        <td>[]</td>
        <td>Main transport hub serving the village</td>
        <td>off</td>
      </tr>";
echo "</table>";
exit;
