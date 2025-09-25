<?php
// templates/washrooms_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=washrooms_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>numberofwashrooms</th>
        <th>locationdescription</th>
        <th>facilitytype</th>
        <th>washroomcondition</th>
        <th>maintenanceschedule</th>
        <th>entityname</th>
        <th>entitytype</th>
        <th>primarycontactperson</th>
        <th>phoneno</th>
        <th>address</th>
        <th>fundingsource</th>
        <th>establisheddate</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>5</td>
        <td>Village Market Area</td>
        <td>Free</td>
        <td>Clean</td>
        <td>Daily cleaning</td>
        <td>Village Panchayat</td>
        <td>Government</td>
        <td>Mr. Sharma</td>
        <td>9876543210</td>
        <td>Main Market Road, Village Center</td>
        <td>Government funding</td>
        <td>2023-05-15</td>
        <td>off</td>
      </tr>";
echo "</table>";
exit;
