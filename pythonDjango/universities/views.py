from django.shortcuts import render
from django.views.generic import UpdateView, ListView, DeleteView, CreateView

from universities.forms import StudentForm, UniversityForm
from universities.models import Student, University


# Create your views here.

def index(request):
    return render(request, 'index.html')


class StudentListView(ListView):
    model = Student
    template_name = 'student_guide.html'
    context_object_name = 'guide'


class StudentCreateView(CreateView):
    model = Student
    template_name = 'student_form.html'
    context_object_name = 'form'
    form_class = StudentForm


class StudentUpdateView(UpdateView):
    model = Student
    template_name = 'student_form.html'
    context_object_name = 'form'
    form_class = StudentForm


class StudentDeleteView(DeleteView):
    model = Student
    success_url = '/students'
    template_name = 'student_delete.html'


class UniversityListView(ListView):
    model = University
    template_name = 'university_guide.html'
    context_object_name = 'guide'


class UniversityCreateView(CreateView):
    model = University
    template_name = 'university_form.html'
    context_object_name = 'form'
    form_class = UniversityForm


class UniversityUpdateView(UpdateView):
    model = University
    template_name = 'university_form.html'
    context_object_name = 'form'
    form_class = UniversityForm


class UniversityDeleteView(DeleteView):
    model = University
    success_url = '/universities'
    template_name = 'university_delete.html'
