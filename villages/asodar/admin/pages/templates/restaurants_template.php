<?php
// templates/restaurants_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=restaurants_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>restaurantname</th>
        <th>photo</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>contactno</th>
        <th>timeschedule</th>
        <th>cuisineserved</th>
        <th>bookingprocess</th>
        <th>websitelink</th>
        <th>customerreviews</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Spice Restaurant</td>
        <td>[]</td>
        <td>Main Market</td>
        <td>Anand</td>
        <td>388001</td>
        <td>9876543210</td>
        <td>{&quot;open&quot;:&quot;11:00&quot;,&quot;close&quot;:&quot;23:00&quot;}</td>
        <td>Indian, Chinese, Continental</td>
        <td>online</td>
        <td>https://villagespice.com</td>
        <td>4.6/5 - Authentic flavors and great service</td>
        <td>on</td>
      </tr>";

echo "</table>";
exit;
