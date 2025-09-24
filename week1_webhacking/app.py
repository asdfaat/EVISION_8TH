from flask import Flask, render_template, request, redirect, url_for
from tinydb import TinyDB, Query

app = Flask(__name__)

# guestbook.json이라는 이름의 데이터베이스를 json 형태로 저장
db = TinyDB('guestbook.json')

# 메인 페이지
@app.route('/')
def home():
    # db에 있는 모든 record 가져오기
    items = db.all()

    # 가져온 record들을 넘겨 표시하도록
    return render_template('main.html', items=items)

# 검색 결과 출력
@app.route('/search')
def search():
    # GET 방식으로 query(q의 값) 가져오기
    # 띄어쓰기 구분 없이 검색 가능하도록 공백 제거
    # 대소문자 구분 없이 검색 가능하도록 소문자로 변경
    query = request.args.get('q', '').strip().lower() # 없으면 ''

    q = Query()

    # 작성자나 메시지에 검색어가 있는 경우
    result = db.search(
        # test: test(func)은 필드의 값을 받아 func(값)의 결과가 true인 문서 반환
        # 람다로 임시 함수를 만들어 넘겨준다.
        q.writer.test(lambda v: query in str(v).strip().lower()) |
        q.message.test(lambda v: query in str(v).strip().lower())
        )
    
    return render_template('main.html', items=result, query=query)

@app.route('/write', methods=['POST'])
def write():
    # post 방식으로 writer와 message 값을 가져오기
    writer = request.form.get('writer', 'None')  # writer 값이 없으면 'None'
    message = request.form.get('message', '') # message 없으면 ''

    # 방명록 저장
    db.insert({
        'writer': writer,
        'message': message
    })

    # 작업이 끝나면 홈 redirect 
    return redirect(url_for('home'))

if __name__ == '__main__':
    app.run(debug=True)
