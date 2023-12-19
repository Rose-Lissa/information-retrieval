from django.urls import path

from universities import views

urlpatterns = [
    path('', views.index, name='index'),
    path('universities/', views.UniversityListView.as_view(), name='universities_guide'),
    path('universities/create/', views.UniversityCreateView.as_view(), name='universities_create'),
    path('universities/<int:pk>/', views.UniversityUpdateView.as_view(), name='universities_edit'),
    path('universities/<int:pk>/delete', views.UniversityDeleteView.as_view(), name='universities_delete'),
    path('students/', views.StudentListView.as_view(), name='students_guide'),
    path('students/create/', views.StudentCreateView.as_view(), name='students_create'),
    path('students/<int:pk>/', views.StudentUpdateView.as_view(), name='students_edit'),
    path('students/<int:pk>/delete/', views.StudentDeleteView.as_view(), name='students_delete')
]
