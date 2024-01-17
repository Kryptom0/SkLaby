from rest_framework import serializers
from django_filters.rest_framework import DjangoFilterBackend
from rest_framework.response import Response
from rest_framework.decorators import action
from django.db.models import Avg
from .models import User, Room, Transport, Reservation, Opinion
from rest_framework import viewsets, filters, status
from .serializer import UserSerializer, RoomSerializer, TransportSerializer, ReservationSerializer, OpinionSerializer
import datetime


# Create your views here.
class UserViewSet(viewsets.ModelViewSet):
    queryset = User.objects.all().order_by('id')
    serializer_class = UserSerializer
    filter_backends = [filters.SearchFilter]
    search_fields = ['=name', '=last_name', 'adress', '^phone_number']


class RoomViewSet(viewsets.ModelViewSet):
    queryset = Room.objects.all().order_by('id')
    serializer_class = RoomSerializer
    filter_backends = [filters.SearchFilter, DjangoFilterBackend]
    search_fields = ['description', '=number_of_rooms', '=area', '=location', '=price_of_day', '=type', '=availability']

    @action(detail=False, methods=['GET'])
    def ranking(self, request):
        ranking = Room.objects.annotate(
            avg_rating=Avg('opinion__rate')).order_by('-avg_rating')[:15]
        for room in ranking:
            if room.avg_rating is not None:
                room.avg_rating = round(room.avg_rating, 2)

        serializer = RoomSerializer(ranking, many=True, context={'request': request})
        return Response(serializer.data)

    @action(detail=True, methods=['GET'])
    def availability(self, request, pk=None):
        room = self.get_object()
        today = datetime.date.today()
        reservations = Reservation.objects.filter(
            room=room,
            end_reservation__gte=today
        )
        booked_dates = set()

        for reservation in reservations:
            current_date = reservation.begin_reservation
            while current_date <= reservation.end_reservation:
                booked_dates.add(current_date)
                current_date += datetime.timedelta(days=1)

        all_dates = set((today + datetime.timedelta(days=i) for i in range(183)))
        available_dates = list(all_dates - booked_dates)
        sorted_dates = sorted(available_dates)

        serializer = DateSerializer({'dates': sorted_dates})
        return Response(serializer.data)


class TransportViewSet(viewsets.ModelViewSet):
    queryset = Transport.objects.all().order_by('id')
    serializer_class = TransportSerializer
    filter_backends = [filters.SearchFilter]
    search_fields = ['starting_location', 'ending_location', '=number_of_people']


class ReservationViewSet(viewsets.ModelViewSet):
    queryset = Reservation.objects.all().order_by('id')
    serializer_class = ReservationSerializer
    filter_backends = [filters.SearchFilter]
    search_fields = ['=room', '=status', 'user']

    def list(self, request, *args, **kwargs):
        queryset = Reservation.objects.all().order_by('id')
        room_id = self.request.query_params.get('room_id', None)
        if room_id:
            queryset = queryset.filter(room_id=room_id)
        serializer = ReservationSerializer(queryset, many=True, context={'request': request})
        return Response(serializer.data)

    def create(self, request, *args, **kwargs):
        room_id = request.data.get('room', None)
        begin_date = request.data.get('begin_reservation', None)
        end_date = request.data.get('end_reservation', None)

        if room_id and begin_date and end_date:
            room = Room.objects.get(pk=room_id)
            existing_reservations = Reservation.objects.filter(
                room=room,
                begin_reservation__lt=end_date,
                end_reservation__gt=begin_date
            )
            if existing_reservations.exists():
                return Response({'error': 'Selected dates are not available for this room.'},
                                status=status.HTTP_400_BAD_REQUEST)

        return super().create(request, *args, **kwargs)


class OpinionViewSet(viewsets.ModelViewSet):
    queryset = Opinion.objects.all().order_by('id')
    serializer_class = OpinionSerializer
    filter_backends = [filters.SearchFilter]
    search_fields = ['room__id', 'review', '=rate']


class DateSerializer(serializers.Serializer):
    dates = serializers.ListField(child=serializers.DateField())
