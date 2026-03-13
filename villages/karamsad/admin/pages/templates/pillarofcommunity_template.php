<?php
// templates/pillarofcommunity_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pillarofcommunity_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>name</th>
        <th>birthdate</th>
        <th>dateofpassing</th>
        <th>profession</th>
        <th>typeofleader</th>
        <th>education</th>
        <th>politicalcareer</th>
        <th>positionsheld</th>
        <th>roleinindependencemovement</th>
        <th>description</th>
        <th>photo</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Shri Ramdas Gandhi</td>
        <td>1940-05-15</td>
        <td>2015-08-22</td>
        <td>Farmer & Social Worker</td>
        <td>sarpanch</td>
        <td>High School Graduate</td>
        <td>Village Development Committee Member (1980-1995)</td>
        <td>Sarpanch (1995-2005)</td>
        <td>Organized freedom marches in 1942</td>
        <td>Beloved village leader who built the community hall and promoted education for girls</td>
        <td>[]</td>
        <td>on</td>
      </tr>";

echo "</table>";
exit;
