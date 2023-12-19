from django.db import models


class University(models.Model):
    full_name = models.CharField(max_length=50)
    short_name = models.CharField(max_length=50)
    foundation_date = models.DateField()

    def __str__(self):
        return self.short_name

    def get_absolute_url(self):
        return '/universities/'

    class Meta:
        verbose_name_plural = 'Университеты'
        verbose_name = 'Университет'


class Student(models.Model):
    name = models.CharField(max_length=50)
    birthday = models.DateField(max_length=50)
    university = models.ForeignKey(University, on_delete=models.PROTECT)
    admission_year = models.IntegerField(default=None)

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return '/students/'

    class Meta:
        verbose_name_plural = 'Студенты'
        verbose_name = 'Студент'
