<?php
// templates/employmentcenters_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=employmentcenters_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>centername</th>
        <th>servicetype</th>
        <th>contactnumber</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Skill Development Center</td>
        <td>Skill Training</td>
        <td>9876543210</td>
        <td>Community Hall</td>
        <td>Anand</td>
        <td>388001</td>
        <td>on</td>
      </tr>";
echo "<tr>
        <td>Job Placement Office</td>
        <td>Job Placement</td>
        <td>9876543211</td>
        <td>Main Market Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>on</td>
      </tr>";

echo "</table>";
exit;
