<?php

include(dirname(__FILE__).'/../conf/db.conf.php');

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//mysqli_select_db("brain_php", $conn);
//mysqli_select_db($conn, "brain_php");
//mysqli_query("set names euckr");

if ($_GET['no'] == null)
    $offset = 0;
else
    $offset = $_GET['no'];

$pagesize = 5;


$query = "SELECT count(id) FROM guestbook";
$result = mysqli_query($conn, $query);
$total = mysqli_fetch_array($result);
$total = $total[0];


//$query = "SELECT * FROM guestbook ORDER BY id DESC LIMIT 5 OFFSET $_GET['no']";
$query = "SELECT * FROM guestbook ORDER BY id DESC LIMIT $pagesize OFFSET $offset";
//$result = mysqli_query($query, $conn);
$result = mysqli_query($conn, $query);
//$total = mysqli_affected_rows($result);
$fetched_rows_num = mysqli_num_rows($result);

?>

    <FORM ACTION="insert.php" METHOD="POST">
        <TABLE BORDER="1" WIDTH="600">
            <TR>
                <TD>이름</TD>
                <TD><INPUT TYPE="TEXT" NAME="name"></TD>
                <TD>비밀번호</TD>
                <TD><INPUT TYPE="PASSWORD" NAME="pass"></TD>
            </TR>
            <TR>
                <TD COLSPAN="4">
                    <TEXTAREA NAME="content" COLS="80" ROWS="5"></TEXTAREA>
                </TD>
            </TR>
            <TR>
                <TD COLSPAN="4" ALIGN="right">
                    <INPUT TYPE="SUBMIT" VALUE=" 확 인 ">
                </TD>
            </TR>
        </TABLE>
    </FORM>
    <BR>

<?php
for ($i = 0; $i < $fetched_rows_num; $i++) {

    $row = mysqli_fetch_array($result);

?>

    <TABLE WIDTH="600" BORDER="1">
        <TR>
            <TD>No. <?= $row['id'] ?></TD>
            <TD><?= $row['name'] ?></TD>
            <TD>(<?= $row['wdate'] ?>)</TD>
            <TD><a href="delete.php?id=<?= $row['id'] ?>">del</a></TD>
        </TR>
        <TR>
            <TD COLSPAN="4"><?= $row['content'] ?></TD>
        </TR>
    </TABLE>

<?php

}  //end for

$prev = $_GET['no'] - $pagesize;  // 이전 페이지는 시작 글에서 $pagesize 를 뺀 값부터
$next = $_GET['no'] + $pagesize;  // 다음 페이지는 시작 글에서 $pagesize 를 더한 값부터

if ($prev >= 0) {
    echo("<a href='$_SERVER[PHP_SELF]?no=$prev'>이전</a> ");
}

if ($next < $total) {
    echo("<a href='$_SERVER[PHP_SELF]?no=$next'>다음</a> ");
}
?>