from .models import User, Room, Transport, Reservation, Opinion
from rest_framework import serializers


class UserSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = User
        fields = ['id', 'name', 'last_name', 'email', 'adress', 'phone_number']


class RoomSerializer(serializers.HyperlinkedModelSerializer):
    avg_rating = serializers.FloatField(read_only=True)

    class Meta:
        model = Room
        fields = ['id', 'description', 'number_of_rooms', 'area', 'max_number_of_people', 'location', 'price_of_day',
                  'number_of_room', 'type', 'availability', 'avg_rating']


class TransportSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Transport
        fields = ['id', 'user', 'starting_location', 'ending_location', 'number_of_people']


class ReservationSerializer(serializers.HyperlinkedModelSerializer):
    room = serializers.PrimaryKeyRelatedField(queryset=Room.objects.all())

    # user = serializers.PrimaryKeyRelatedField(queryset=User.objects.all())  #id

    class Meta:
        model = Reservation
        fields = ['id', 'user', 'room', 'begin_reservation', 'end_reservation', 'number_of_people', 'status']

    def validate(self, data):
        begin_date = data['begin_reservation']
        end_date = data['end_reservation']

        if begin_date > end_date:
            raise serializers.ValidationError("Begin date must be before end date.")

        return data


class OpinionSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Opinion
        fields = ['id', 'room', 'author', 'review', 'rate', 'date_of_issue']


class DateSerializer(serializers.Serializer):
    date = serializers.ListField(child=serializers.DateField())
