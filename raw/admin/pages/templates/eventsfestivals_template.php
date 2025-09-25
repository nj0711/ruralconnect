<?php
// templates/eventsfestivals_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=eventsfestivals_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>eventname</th>
        <th>eventtype</th>
        <th>startdate</th>
        <th>enddate</th>
        <th>contactnumber</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Navratri Festival</td>
        <td>Religious</td>
        <td>2024-10-03</td>
        <td>2024-10-11</td>
        <td>9876543210</td>
        <td>9-day festival celebrating Goddess Durga with Garba dances</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
