# Generated by Django 5.0 on 2024-01-14 13:18

import django.db.models.deletion
from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('wynajem', '0010_rename_max_number_of_people_transport_number_of_people_and_more'),
    ]

    operations = [
        migrations.AlterField(
            model_name='opinion',
            name='review',
            field=models.TextField(max_length=255),
        ),
        migrations.CreateModel(
            name='Availability',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('date', models.DateField()),
                ('is_available', models.BooleanField(default=True)),
                ('room', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='availabilities', to='wynajem.room')),
            ],
        ),
    ]