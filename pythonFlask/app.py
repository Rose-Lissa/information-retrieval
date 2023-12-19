from datetime import datetime

from flask import Flask, render_template, request, redirect
from flask_login import login_user, login_required, LoginManager, current_user, logout_user
from flask_migrate import Migrate
from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()
app = Flask(__name__)
login_manager = LoginManager()
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///sample.db'
app.config['SECRET_KEY'] = '5fa2d625b0a710bdfbd38a497ed64e9b596d4a63'
db.init_app(app)
login_manager.init_app(app)
migrate = Migrate(app, db)


class UserLogin:
    def __init__(self):
        self.__user = None

    def from_db(self, user_id):
        self.__user = User.query.filter_by(id=user_id).first()
        return self

    def create(self, user):
        self.__user = user
        return self

    def is_authenticated(self):
        return True

    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        return str(self.__user.id)


@login_manager.user_loader
def load_user(user_id):
    return UserLogin().from_db(user_id)


class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    login = db.Column(db.String(20), unique=True, nullable=False)
    password = db.Column(db.String(40), nullable=False)

    def check_password(self, password):
        return self.password == password


class University(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(50), nullable=False)
    short_name = db.Column(db.String(50), nullable=False)
    foundation_date = db.Column(db.Date)


class Student(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False)
    birthday = db.Column(db.Date, nullable=False)
    university_id = db.Column(db.Integer, db.ForeignKey('university.id'), nullable=False)
    university = db.relationship('University', lazy=True)
    admission_year = db.Column(db.Integer, nullable=False)


@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect('/authentication')


@app.route('/authentication', methods=['GET', 'POST'])
def authentication():
    if request.method == 'POST':
        login = request.form['login']
        password = request.form['password']
        user = User.query.filter_by(login=login).first()
        if user is None or not user.check_password(password):
            return render_template('auth.html', error='Неверный логин или пароль')
        else:
            user_login = UserLogin().create(user)
            login_user(user_login)
            return redirect('/')

    return render_template('auth.html', error='')


@app.route('/registration', methods=['GET', 'POST'])
def registration():
    if request.method == 'POST':
        login = request.form['login']
        password = request.form['password']
        repeat_password = request.form['repeat_password']
        user = User.query.filter_by(login=login).first()
        if not (user is None):
            return render_template('reg.html', error='Такой пользователь уже существует')

        if password != repeat_password:
            return render_template('reg.html', error='Пароли не совпадают')

        user = User(login=login, password=password)
        db.session.add(user)
        db.session.commit()
        return redirect('/authentication')

    return render_template('reg.html', error='')


@app.route('/')
def index():
    is_login = not isinstance(current_user, UserLogin)
    return render_template('index.html', is_login=is_login)


@app.route('/students')
def students_guide():
    students = Student.query.all()
    return render_template('student_guide.html', guide=students)


@app.route('/universities')
def universities_guide():
    universities = University.query.all()
    return render_template('university_guide.html', guide=universities)


@app.route('/students/create', methods=['GET', 'POST'])
@login_required
def students_create():
    universities = University.query.all()
    if request.method == 'POST':
        name = request.form['name']
        birthday = datetime.strptime(request.form['birthday'], '%Y-%m-%d').date()
        university_id = request.form['university_id']
        admission_year = request.form['admission_year']
        student = Student(name=name, birthday=birthday, university_id=university_id, admission_year=admission_year)
        db.session.add(student)
        db.session.commit()
        return redirect('/students')

    return render_template('student_form.html', form={}, universities=universities)


@app.route('/universities/create', methods=['GET', 'POST'])
@login_required
def universities_create():
    if request.method == 'POST':
        full_name = request.form['full_name']
        short_name = request.form['short_name']
        foundation_date = datetime.strptime(request.form['foundation_date'], '%Y-%m-%d').date()
        university = University(full_name=full_name, short_name=short_name, foundation_date=foundation_date)
        db.session.add(university)
        db.session.commit()
        return redirect('/universities')

    return render_template('university_form.html', form={})


@app.route('/students/<int:id>', methods=['GET', 'POST'])
@login_required
def students_update(id):
    universities = University.query.all()
    student = Student.query.get_or_404(id)
    if request.method == 'POST':
        student.name = request.form['name']
        student.birthday = datetime.strptime(request.form['birthday'], '%Y-%m-%d').date()
        student.university_id = request.form['university_id']
        student.admission_year = request.form['admission_year']
        db.session.commit()
        return redirect('/students')

    print(student)
    return render_template('student_form.html', form=student, universities=universities)


@app.route('/universities/<int:id>', methods=['GET', 'POST'])
@login_required
def universities_update(id):
    university = University.query.get_or_404(id)
    if request.method == 'POST':
        university.full_name = request.form['full_name']
        university.short_name = request.form['short_name']
        university.foundation_date = datetime.strptime(request.form['foundation_date'], '%Y-%m-%d').date()
        db.session.commit()
        return redirect('/universities')

    return render_template('university_form.html', form=university)


@app.route('/students/<int:id>/delete', methods=['GET', 'POST'])
@login_required
def students_delete(id):
    if request.method == 'POST':
        Student.query.filter_by(id=id).delete()
        db.session.commit()
        return redirect('/students')

    return render_template('student_delete.html', id=id)


@app.route('/universities/<int:id>/delete', methods=['GET', 'POST'])
@login_required
def universities_delete(id):
    if request.method == 'POST':
        University.query.filter_by(id=id).delete()
        db.session.commit()
        return redirect('/universities')

    return render_template('university_delete.html', id=id)


if __name__ == '__main__':
    app.run()
