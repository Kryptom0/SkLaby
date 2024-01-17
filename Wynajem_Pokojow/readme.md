# Temat - Wynajem pokoju
### Wymagania: 
- Zarządzanie baza noclegową - Administrator -
- Ocena noclegów -
- Rezerwacja pokoju -
- Ranking według najlepszych ocen -
- Kalendarz dostępności -
- Transport -
- Wyszukiwanie -

### Modele:
- Użytkownik
- Pokój 
- Transport
- Rezerwacja
- Opinia

### Model Użytkownik:
- ID Użytkownika(Klucz główny)
- Imie
- Nazwisko
- Adres Email
- Adres zamieszkania
- Numer telefonu

### Model Pokój:
- ID pokoju(Klucz główny)
- Opis obiektu
- Liczba pomieszczeń
- Powierzchnia
- Max liczba osób
- Lokalizacja
- Cena/doba
- Numer pokoju
- Typ(Jednoosobowy, Dwuosobowy, Apartament)
- Dostepność(Tak, Nie)

### Model Tranport:
- ID Transportu(Klucz główny)
- ID Użytkownik(Klucz obcy)
- Lokalizacja pcozątkowa
- Lokalizacja końcowa
- Max liczba osob

### Model Rezerwacja:
- ID Rezerwacji(Klucz główny)
- ID Uzytkownika(Klucz obcy)
- ID Pokoju(Klucz obcy)
- Początek rezerwacji
- Koniec rezerwacji
- Liczba gości
- Status(Potwierdzona, oczekująca, anulowana)

### Model Opinia:
- ID Opinii(Klucz główny)
- ID Pokoju(Klucz obcy)
- ID Użytkownik(Klucz obcy)
- Treść opinii
- Ocena
- Data wystawienia

### Opis wymagań:
- Zarządzanie baza noclegową - Administrator
(Realizowane za pomoga Django admin Panel: /admin)
- Ocena noclegów  
(Użytkownicya mogą wystawiać oceny pokojom wraz z opinia.
Wykorzystuje modele Room i User.)
- Rezerwacja pokoju  
(Realizowane operacje CRUD na Modelu Rezerwacja.
Wykorzystuje modele Room i User)
- Ranking według najelpszych ocen   
(System tworzenia rankingu na podstawie ocen pokojów.
Liczona jest srednia dla danego pokoju i brane pierwsze 15 pokoji.)
- Kalendarz dostępności    
(Wyswietlane wszystkie dni do pół roku w których dany pokoj nie ma rezerwacji.)
- Transport   
(Realizowane CRUD za pomoca Modelu Transport - Wykorzystuje Model User)
- Wyszukiwanie   
(Specjalna funkcja wyszukujaca pokoj po roznych kryteriach )