# Generated by Django 5.0 on 2023-12-19 18:49

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('wynajem', '0003_alter_room_type'),
    ]

    operations = [
        migrations.AlterField(
            model_name='room',
            name='availability',
            field=models.CharField(choices=[('Yes', 'Accessible'), ('No', 'Inaccessible')], max_length=20),
        ),
    ]