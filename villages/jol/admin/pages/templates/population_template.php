<?php
// templates/population_template.php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=population_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>totalnoofmale</th>
        <th>totalnooffemale</th>
        <th>totalnoofchildren</th>
        <th>birthanddeathratio</th>
        <th>religionandpopulation</th>
        <th>occupationandpopulation</th>
        <th>educationandpopulation</th>
        <th>salaryandpopulation</th>
        <th>agewisemale</th>
        <th>agewisefemale</th>
      </tr>";
echo "<tr>
        <td>1200</td>
        <td>1100</td>
        <td>450</td>
        <td>15:3</td>
        <td>{&quot;tot_hindus&quot;:1900,&quot;tot_muslims&quot;:500,&quot;tot_christians&quot;:200,&quot;tot_sikh&quot;:0,&quot;tot_others&quot;:200}</td>
        <td>{&quot;tot_farmers&quot;:800,&quot;tot_govEmp&quot;:400,&quot;occ_3_name&quot;:&quot;Business&quot;,&quot;occ_3&quot;:300,&quot;occ_4_name&quot;:&quot;Labor&quot;,&quot;occ_4&quot;:600,&quot;occ_5_name&quot;:&quot;Other&quot;,&quot;occ_5&quot;:200}</td>
        <td>{&quot;tot_10&quot;:800,&quot;tot_12&quot;:600,&quot;tot_ugs&quot;:300,&quot;tot_pgs&quot;:100,&quot;tot_nonedus&quot;:500}</td>
        <td>{&quot;inc_above_15&quot;:100,&quot;inc_10_15&quot;:300,&quot;inc_3_10&quot;:600,&quot;inc_below_3&quot;:700}</td>
        <td>{&quot;tot_100_m&quot;:70,&quot;tot_80_m&quot;:180,&quot;tot_60_m&quot;:500,&quot;tot_40_m&quot;:250,&quot;tot_20_m&quot;:200}</td>
        <td>{&quot;tot_100_f&quot;:100,&quot;tot_80_f&quot;:150,&quot;tot_60_f&quot;:450,&quot;tot_40_f&quot;:220,&quot;tot_20_f&quot;:180}</td>
        
      </tr>";
echo "</table>";
exit;
