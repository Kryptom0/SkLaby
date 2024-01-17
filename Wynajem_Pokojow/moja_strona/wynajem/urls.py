from django.urls import include, path
from rest_framework import routers
from .views import UserViewSet, RoomViewSet, TransportViewSet, ReservationViewSet, OpinionViewSet

router = routers.DefaultRouter()
router.register(r'users', UserViewSet)
router.register(r'rooms', RoomViewSet)
router.register(r'transports', TransportViewSet)
router.register(r'reservations', ReservationViewSet)
router.register(r'opinions', OpinionViewSet)

urlpatterns = [
    path('', include(router.urls)),
    path('api-auth/', include('rest_framework.urls', namespace='rest_framework'))
]
urlpatterns += router.urls
