from django.db import models


# Create your models here.
class User(models.Model):
    id = models.IntegerField(primary_key=True, editable=False)
    name = models.CharField(max_length=255, null=False)
    last_name = models.CharField(max_length=255, null=False)
    email = models.EmailField(max_length=100)
    adress = models.TextField(max_length=255, null=False)
    phone_number = models.CharField(max_length=9, null=False)

    def __str__(self):
        return f'User id ({self.id})'


class Room(models.Model):
    id = models.IntegerField(primary_key=True, editable=False)
    description = models.TextField(max_length=255, null=False)
    number_of_rooms = models.PositiveIntegerField(null=False, default=1)
    area = models.PositiveIntegerField(null=False)
    max_number_of_people = models.PositiveIntegerField(default=1, null=False)
    location = models.CharField(max_length=255, null=False)
    price_of_day = models.PositiveIntegerField(null=False)
    number_of_room = models.PositiveIntegerField(null=False)
    type = models.CharField(choices=(('Single', 'Single'), ('Double', 'Double'), ('Apartament', 'Apartament')),
                            max_length=25, null=False)
    availability = models.CharField(choices=(('Accessible', 'Accessible'), ('Inaccessible', 'Inaccessible')),
                                    max_length=25, null=False)

    def __str__(self):
        return f'Room id ({self.id})'


class Transport(models.Model):
    id = models.IntegerField(primary_key=True, editable=False)
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    starting_location = models.CharField(max_length=255, null=False, default='Dworzec')
    ending_location = models.CharField(max_length=240, null=False, default='Room')
    number_of_people = models.PositiveIntegerField(default=4, null=False)

    def __str__(self):
        return f'Transport id ({self.id})'


class Reservation(models.Model):
    id = models.IntegerField(primary_key=True, null=False, editable=False),
    user = models.ForeignKey(User, null=False, on_delete=models.CASCADE)
    room = models.ForeignKey(Room, null=False, on_delete=models.CASCADE)
    begin_reservation = models.DateField(null=False)
    end_reservation = models.DateField(null=False)
    number_of_people = models.PositiveIntegerField(null=False, default=1)
    status = models.CharField(choices=(('Confirmed', 'Confirmed'), ('Waiting', 'Waiting'), ('Canceled', 'Canceled')),
                              max_length=30, default="Waiting")

    def __str__(self):
        return f'Reservation Id ({self.id})'

    class Meta:
        unique_together = ('room', 'begin_reservation', 'end_reservation')


class Opinion(models.Model):
    id = models.IntegerField(primary_key=True, editable=False)
    room = models.ForeignKey(Room, null=False, on_delete=models.CASCADE)
    author = models.ForeignKey(User, null=False, on_delete=models.CASCADE)
    review = models.TextField(max_length=500, null=False)
    rate = models.PositiveSmallIntegerField(
        choices=((1, '1 Star'), (2, '2 Star'), (3, '3 Star'), (4, '4 Star'), (5, '5 Star')), null=False)
    date_of_issue = models.DateField(auto_now_add=True)

    def __str__(self):
        return f'Opinion Id ({self.id})'
