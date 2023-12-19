from django.forms import TextInput, ModelForm, DateInput, NumberInput

from universities.models import Student, University


class StudentForm(ModelForm):
    class Meta:
        model = Student
        fields = ['name', 'birthday', 'university', 'admission_year']

        widgets = {
            'name': TextInput(attrs={'maxlength': 50, 'required': 'required'}),
            'birthday': DateInput(
                format='%Y-%m-%d',
                attrs={'required': 'required', 'type': 'date'}),
            'admission_year': NumberInput(attrs={'maxlength': 50, 'required': 'required'})
        }


class UniversityForm(ModelForm):
    class Meta:
        model = University
        fields = ['full_name', 'short_name', 'foundation_date']

        widgets = {
            'full_name': TextInput(attrs={'maxlength': 100, 'required': 'required'}),
            'short_name': TextInput(attrs={'maxlength': 100, 'required': 'required'}),
            'foundation_date': DateInput(
                format='%Y-%m-%d',
                attrs={'required': 'required', 'type': 'date'})
        }
