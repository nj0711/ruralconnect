<?php
// templates/hospitals_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=hospitals_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>type</th>
        <th>name</th>
        <th>photo</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>contactno</th>
        <th>timeduration</th>
        <th>patientcapacity</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Hospital</td>
        <td>Village General Hospital</td>
        <td>[]</td>
        <td>Main Hospital Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>9876543210</td>
        <td>{&quot;open&quot;:&quot;00:00&quot;,&quot;close&quot;:&quot;23:59&quot;}</td>
        <td>150</td>
        <td>Multi-specialty hospital with 24/7 emergency services</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
