<?php
$db_host = "localhost";  // db 서버의 ip or 도메인 주소
$db_user = "root";   // db 사용자 id
$db_pass = "";   // db 사용자 비밀번호
$db_name = "my_db";  // db 이름
$db_port = 3306; // 포트가 3306이 아닌 다른 포트라면 포트 번호도 적어줘야
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port); // 클래스 생성자 -> 객체 지향 방식


if ($conn->connect_error)
{
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// html 파일에서 POST 방식으로 보낸 데이터 받기
$username = $_POST['username'];
$password = $_POST['password'];

// sql 쿼리 작성 및 실행 - 입력받은 username과 password가 일치하는 사용자 찾기
/*
$sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
$result=$conn->query($sql);
query()는 파라미터 없는 간단한 조회에 사용(non-prepared statement)
이 경우 파라미터에 대한 검증 없이 실행시키기 때문에 sql injection이 가능해진다.
*/
//prepared statements(=parameterized statement) 방식으로 실행
//  prepare -> bind -> execute
$sql = "SELECT * FROM users WHERE username=? AND password=?"; // 파라미터 부분에 ? 
$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $username, $password); # 둘 다 string 형식으로

$stmt->execute();


// 결과 확인
$result = $stmt->get_result();
if ($result->num_rows > 0) 
{
    // 조회된 것이 있으면(일치한 사용자가 있으면)
    echo "<h1>로그인 성공!</h1>";
    $escaped_username = $conn->real_escape_string($username);
    echo "'$escaped_username'님, 환영합니다.";
}
else
{
    echo "<h1>로그인 실패</h1>";
    echo "<p>아이디 또는 비밀번호가 올바르지 않습니다.</p>";
    echo '<a href="login.html">다시 시도하기</a>';
}
?>