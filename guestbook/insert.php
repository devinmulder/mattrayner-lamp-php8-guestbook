<?php

$conn = mysqli_connect("localhost", "admin", "apmsetup", "brain_php");
//mysqli_select_db("brain_php", $conn);
// mysqli_select_db($conn, "brain_php");
//mysqli_query("set names euckr");

$query = "INSERT INTO guestbook (name, pass, content) VALUES ('$_POST[name]', '$_POST[pass]', '$_POST[content]')";
//$result = mysqli_query($query, $conn);
$result = mysqli_query($conn, $query);
?>

<script>
    alert("글이 등록 되었습니다..");
    location.href = "list.php";
</script>

