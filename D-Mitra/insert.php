

<?php
$link=mysqli_connect("localhost","root","","pgm9_db");
if(!$link)
die(mysqli_connect_error());
if(isset($_POST['submit']))
{
$stud_name = $_POST['name'];
$stud_add1 = $_POST['add1'];
$stud_add2 = $_POST['add2'];
$stud_email = $_POST['email'];
$query = "insert into student_table(name, add1, add2, email)
values ('$stud_name', '$stud_add1', '$stud_add2', '$stud_email')";
mysqli_query($link,$query);
echo '<script>';
echo'alert("Added successfully ");';
echo 'window.location="http://localhost/Program%209/submit1.html";';
echo '</script>';
}
?>