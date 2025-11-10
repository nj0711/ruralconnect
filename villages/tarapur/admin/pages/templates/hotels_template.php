<?php
// templates/hotels_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=hotels_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>hotelname</th>
        <th>photo</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>contactno</th>
        <th>timeschedule</th>
        <th>amenities</th>
        <th>bookingprocess</th>
        <th>websitelink</th>
        <th>customerreviews</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Heritage Hotel</td>
        <td>[]</td>
        <td>Main Street</td>
        <td>Anand</td>
        <td>388001</td>
        <td>9876543210</td>
        <td>{&quot;open&quot;:&quot;07:00&quot;,&quot;close&quot;:&quot;23:00&quot;}</td>
        <td>AC Rooms, Restaurant, Parking, WiFi, Laundry</td>
        <td>online</td>
        <td>https://villageheritage.com</td>
        <td>4.5/5 - Excellent service and clean rooms</td>
        <td>on</td>
      </tr>";


echo "</table>";
exit;
