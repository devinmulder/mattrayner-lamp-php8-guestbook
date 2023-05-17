<?php
if ($_GET[mode] != "delete")
{
?>

<HTML>
<FORM METHOD="POST" ACTION="<?= $_SERVER[PHP_SELF] ?>?id=<?= $_GET[id] ?>&mode=delete">
    <TABLE>
        <TR>
            <TD>비밀번호</TD>
            <TD><INPUT TYPE="PASSWORD" NAME="pass"></TD>
            <TD><input TYPE="SUBMIT" VALUE=" 확 인 "></TD>
        </TR>
    </TABLE>

    <?php
    exit;
    }  //end if

    $conn = mysqli_connect("localhost", "admin", "apmsetup", "barin_php");
    //@mysqli_select_db("brain_php", $conn);
    // @mysqli_select_db($conn, "brain_php");
    //@mysqli_query("set names euckr");

    $query = "SELECT pass FROM guestbook WHERE id='$_GET[id]'";
//    $result = mysqli_query($query, $conn);
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if ($row[pass] == $_POST[pass]) {
        $query = "DELETE FROM guestbook WHERE id='$_GET[id]'";
        $result = mysqli_query($conn, $query);

        $authentication_result = "글이 삭제되었습니다.";
    } else {

        $authentication_result = "비밀번호가 틀립니다.";
    }

    ?>

    <script>
        alert("<?=$authentication_result?>");
        location.href = "list.php";
    </script>
