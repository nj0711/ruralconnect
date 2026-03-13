<?php
// templates/electrification_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=electrification_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>companyname</th>
        <th>emergencycontactno</th>
        <th>energyresourcessolar</th>
        <th>energyresourceswind</th>
        <th>energyresourcescoal</th>
        <th>energyresourcesgas</th>
        <th>photo</th>
        <th>officeaddress</th>
        <th>city</th>
        <th>pincode</th>
        <th>servicearea</th>
        <th>contactno</th>
        <th>email</th>
        <th>supplychain</th>
        <th>description</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Village Power Co.</td>
        <td>9876543210</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
        <td>0</td>
        <td>[]</td>
        <td>Main Office Building</td>
        <td>Anand</td>
        <td>388001</td>
        <td>Village Center, East Wing, West Extension</td>
        <td>9876543211</td>
        <td>info@villagepower.co.in</td>
        <td>Generation Station -> Substation -> Distribution</td>
        <td>Provides reliable electricity to 500+ households</td>
        <td>on</td>
      </tr>";

echo "</table>";
exit;
