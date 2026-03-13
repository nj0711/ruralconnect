<?php
// templates/placestoworship_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=placestoworship_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>name</th>
        <th>history</th>
        <th>photo</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>timeschedule</th>
        <th>contactno</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Shri Ram Temple</td>
        <td>Built in 1850, renovated in 2005</td>
        <td>[]</td>
        <td>Main Temple Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>{&quot;weekdayopenkey&quot;:&quot;05:00&quot;,&quot;weekdayclosekey&quot;:&quot;21:00&quot;,&quot;weekendopenkey&quot;:&quot;04:00&quot;,&quot;weekendclosekey&quot;:&quot;22:00&quot;}</td>
        <td>9876543210</td>
        <td>Ancient temple dedicated to Lord Ram with beautiful architecture</td>
        <td>on</td>
      </tr>";

echo "</table>";
exit;
