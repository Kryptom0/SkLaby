from django.contrib import admin
from .models import User, Room, Transport, Reservation, Opinion


# Register your models here.
@admin.register(User)
class UserAdmin(admin.ModelAdmin):
    list_display = ['id', 'name', 'last_name', 'email', 'adress', 'phone_number']
    search_fields = ['name', 'last_name', 'email', 'adress', 'phone_number']
    list_filter = ['name']


@admin.register(Room)
class RoomAdmin(admin.ModelAdmin):
    list_display = ['id', 'description', 'number_of_rooms', 'area', 'max_number_of_people', 'location', 'price_of_day',
                    'number_of_room', 'type', 'availability']
    search_fields = ['description', 'number_of_rooms', 'area', 'location', 'price_of_day''type', 'availability']
    list_filter = ['description', 'number_of_rooms', 'area', 'location', 'price_of_day', 'type', 'availability']


@admin.register(Transport)
class TransportAdmin(admin.ModelAdmin):
    list_display = ['id', 'user', 'starting_location', 'ending_location', 'number_of_people']
    search_fields = ['starting_location', 'ending_location', 'number_of_people']
    list_filter = ['starting_location', 'ending_location', 'number_of_people']


@admin.register(Reservation)
class ReservationAdmin(admin.ModelAdmin):
    list_display = ['id', 'user', 'room', 'begin_reservation', 'end_reservation', 'number_of_people', 'status']
    search_fields = ['number_of_people', 'status']
    list_filter = ['number_of_people', 'status']


@admin.register(Opinion)
class OpinionAdmin(admin.ModelAdmin):
    list_display = ['id', 'room', 'author', 'review', 'rate', 'date_of_issue']
    search_fields = ['rate', 'review']
    list_filter = ['rate', 'rate']
