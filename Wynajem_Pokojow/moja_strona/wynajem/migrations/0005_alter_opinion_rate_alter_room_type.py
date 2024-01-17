# Generated by Django 5.0 on 2023-12-19 19:56

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('wynajem', '0004_alter_room_availability'),
    ]

    operations = [
        migrations.AlterField(
            model_name='opinion',
            name='rate',
            field=models.CharField(choices=[('Very bad', '1/5'), ('Bad', ' 2/5'), ('Middling', '3/5'), ('Good', '4/5'), ('Very Good', '5/5')], max_length=20),
        ),
        migrations.AlterField(
            model_name='room',
            name='type',
            field=models.CharField(choices=[('One person', 'Single'), ('Two person', 'Double'), ('More person', 'Apartament')], max_length=25),
        ),
    ]