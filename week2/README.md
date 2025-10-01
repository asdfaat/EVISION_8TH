# 로그인 시스템
xampp(mysql과 apache)와 php를 활용한 로그인 시스템

xampp:

mysql:

apache:

## 실행 방법
1. C:\xampp\htdocs\login_project에 login.html과 login_preocess.php 파일 저장
2. DB 생성
  1) xampp에서 apache와 mysql 실행
  2) http://localhost/phpmyadmin에 접속해 my_db 데이터베이스 생성
  3) 'users'라는 이름의 컬럼 세 개를 가진 테이블 생성
       테이블 구조:
         - id: Primary key,INT, A_I(auto_increasment)
         - username: 로그인에 사용할 id, VARCHAR, 길이 50
         - password: 로그인에 사용할 password, VARCHAR, 길이 255
  4) 필요한 데이터 삽입
       - eg. ``` INSERT INTO `users`(`username`, `password`) VALUES ('asdf','asdf') ```
4. http://localhost/login_project/login.html 에서 실행!
   - 아이디와 패스워드 입력
     <img width="307" height="207" alt="image" src="https://github.com/user-attachments/assets/de39cc64-dbaa-4a51-9ad2-a2826bfef4f2" />
   - 로그인 확인
     <img width="211" height="107" alt="image" src="https://github.com/user-attachments/assets/15a62195-5fb2-465a-931b-344e7ec54e79" />
     <img width="319" height="160" alt="image" src="https://github.com/user-attachments/assets/ffb45d9f-612f-4768-ab42-fd507854327e" />

# SQL Injection
