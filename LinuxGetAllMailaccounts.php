<?php
$pass = exec('cat /etc/psa/.psa.shadow');
$db = mysqli_connect('localhost','admin',$pass);
mysql_select_db($db, 'psa');

echo "EMail - Passwörter\n";

$res = mysqli_query($db, "SELECT CONCAT_WS('@',mail.mail_name,domains.name) as mail ,accounts.password FROM domains,mail,accounts WHERE domains.id=mail.dom_id AND accounts.id=mail.account_id ORDER BY mail AS
C");

while($row = mysqli_fetch_assoc($res))
{
    if($row['password'] != '')
    {
        echo $row['mail'] . "\n";
    }
}
