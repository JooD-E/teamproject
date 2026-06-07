<?
 $connect=mysqli_connect( "localhost", "chodasung", "eotjd7181!","chodasung") or  
        die( "SQL server에 연결할 수 없습니다."); 

    mysqli_select_db($connect,"chodasung");
//localhost, username,pw,dbname
?>