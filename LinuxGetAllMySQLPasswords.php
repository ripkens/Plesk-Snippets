<?php
$pass = exec('cat /etc/psa/.psa.shadow');
$db = mysqli_connect('localhost','admin',$pass);
mysqli_select_db($db, 'psa');

echo "DB - Passwörter\n";

$res = mysqli_query($db, "SELECT domains.name AS domain_name,
data_bases.name AS database_name, db_users.login, accounts.password
FROM data_bases, db_users, domains, accounts
WHERE data_bases.dom_id = domains.id
AND db_users.db_id = data_bases.id
AND db_users.account_id = accounts.id
ORDER BY domain_name;");

while($row = mysqli_fetch_assoc($res))
{
    echo str_pad($row['database_name'], 50, ' ', STR_PAD_RIGHT) . str_pad($row['login'], 50, ' ', STR_PAD_RIGHT) . exec("./lib_deplesk.py '".$row['password']."'") . "\n";
}
