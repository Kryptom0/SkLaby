# Generated by Django 5.0 on 2024-01-11 19:06

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('wynajem', '0008_alter_transport_price'),
    ]

    operations = [
        migrations.AlterField(
            model_name='reservation',
            name='number_of_people',
            field=models.PositiveIntegerField(default=1),
        ),
        migrations.AlterField(
            model_name='room',
            name='area',
            field=models.PositiveIntegerField(),
        ),
        migrations.AlterField(
            model_name='room',
            name='max_number_of_people',
            field=models.PositiveIntegerField(default=1),
        ),
        migrations.AlterField(
            model_name='room',
            name='number_of_room',
            field=models.PositiveIntegerField(),
        ),
        migrations.AlterField(
            model_name='room',
            name='number_of_rooms',
            field=models.PositiveIntegerField(default=1),
        ),
        migrations.AlterField(
            model_name='room',
            name='price_of_day',
            field=models.PositiveIntegerField(),
        ),
        migrations.AlterField(
            model_name='transport',
            name='max_number_of_people',
            field=models.PositiveIntegerField(default=4),
        ),
    ]
