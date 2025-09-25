<?php
// templates/banks_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=banks_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>bankname</th>
        <th>email</th>
        <th>phoneno</th>
        <th>address</th>
        <th>numberofatms</th>
        <th>branchcode</th>
        <th>operationalstatus</th>
        <th>otherserviceinformation</th>
        <th>servicetype</th>
        <th>servicedescription</th>
        <th>timeschedule</th>
        <th>photo</th>
        <th>type</th>
        <th>visibility</th>
      </tr>";
echo "<tr>
        <td>Example Bank</td>
        <td>example@bank.com</td>
        <td>9876543210</td>
        <td>123 Main Street</td>
        <td>2</td>
        <td>BR001</td>
        <td>Open</td>
        <td>ATM, Loans</td>
        <td>Retail Banking</td>
        <td>Full service bank</td>
        <td>{&quot;open&quot;:&quot;09:00&quot;,&quot;close&quot;:&quot;17:00&quot;}</td>
        <td>[]</td>
        <td>bank</td>
        <td>1</td>
      </tr>";
echo "</table>";
exit;
