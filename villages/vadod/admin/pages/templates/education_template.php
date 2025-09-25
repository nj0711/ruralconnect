<?php
// templates/education_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=education_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>name</th>
        <th>address</th>
        <th>city</th>
        <th>zip</th>
        <th>facilityavailable</th>
        <th>photo</th>
        <th>contactno</th>
        <th>emailid</th>
        <th>description</th>
        <th>type</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Green Valley School</td>
        <td>Main Road</td>
        <td>Anand</td>
        <td>388001</td>
        <td>Computer Lab, Library, Playground, Science Lab</td>
        <td>[]</td>
        <td>9876543210</td>
        <td>info@gvschool.edu</td>
        <td>CBSE affiliated school with 500+ students</td>
        <td>scl</td>
        <td>on</td>
      </tr>";
echo "</table>";
exit;
