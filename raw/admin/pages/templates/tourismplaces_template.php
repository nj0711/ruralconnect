<?php
// templates/tourismplaces_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=tourismplaces_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>name</th>
        <th>type</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>timeduration</th>
        <th>contactno</th>
        <th>email</th>
        <th>weekdayopenkey</th>
        <th>weekdayclosekey</th>
        <th>weekendopenkey</th>
        <th>weekendclosekey</th>
        <th>amenitiesfacilities</th>
        <th>entryfees</th>
        <th>history</th>
        <th>photo</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Example Temple</td>
        <td>Cultural and Heritage</td>
        <td>Main Street Village</td>
        <td>Village Town</td>
        <td>123456</td>
        <td>{&quot;open&quot;:&quot;11:00&quot;,&quot;close&quot;:&quot;23:00&quot;}</td>
        <td>9876543210</td>
        <td>temple@village.com</td>
        <td>09:00</td>
        <td>17:00</td>
        <td>10:00</td>
        <td>18:00</td>
        <td>Parking, Restroom, Guide</td>
        <td>50</td>
        <td>Built in 1850, historical site</td>
        <td>[]</td>
        <td>Beautiful temple with ancient architecture</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
