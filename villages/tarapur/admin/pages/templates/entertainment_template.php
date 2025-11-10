<?php
// templates/entertainment_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=entertainment_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>name</th>
        <th>type</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>timeschedule</th>
        <th>contactno</th>
        <th>description</th>
        <th>photo</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Star Cinema</td>
        <td>theater</td>
        <td>Main Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>{&quot;weekdayopenkey&quot;:&quot;10:00&quot;,&quot;weekdayclosekey&quot;:&quot;22:00&quot;}</td>
        <td>9876543210</td>
        <td>3-screen multiplex cinema with Dolby sound</td>
        <td>[]</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
