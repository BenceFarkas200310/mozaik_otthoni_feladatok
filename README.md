## MOZAIK - Otthoni feladatok

**1. feladat: Gyűjtemények (JS)**

Az alkalmazás JSON fájl-ban tárolja a gyűjtemények adatait, ezért még mielőtt elindítanánk **szükség van egy JSON szerver futtatására**. Ehhez szükséges lesz telepíteni a **Node.js**-t. Ha megvan a Node.js, érdemes először egy IDE-ben megnyitni a projektet ("j**avascript_feladat** mappát"), majd a terminálban ezet a parancsot futtatni:

    json-server --watch data.json

Fontos, hogy a szerver a 3000-es porton fusson (ez az alapértelmezett). Ha bármi okból mégsem ezen a porton fut, a parancsot egészítsük ki ezzel: `--port 3000` !

Ha ez megvan és fut a szerver, akkor érdemes a weblapot **Live Server**-t használva megnyitni.

**2. feladat: Versenykezelő (php)**
A webalkalmazás MySQL adatbázisban tárolja az adatokat, legelőször ezt kell elindítani. Fontos meggyőződni róla, hogy az adatbázis a **3306**-os porton fut. Hozzuk létre a "**versenykezelo**" nevű adatbázist!
Ezután nyissuk meg a projektet (**php_feladat** mappa) egy IDE-ben és a terminálban a következő parancsokat futtatni:

    php artisan migrate
    php artisan db:seed

Győződjünk meg róla, hogy a táblázatok létrejöttek és a "users", illetve "competitions" tábla fel van töltve adatokkal.
Indítsuk el a webalkalmazást a következő paranccsal:

    php artisan serve

Indításkor 5 darab felhasználó áll rendelkezésünkre, ebből egy van admin jogosultságokkal felruházva (**email: admin@teszt.com, jelszó: 123456789**). A funkciók csak ezzel a felhasználóval érhetőek el és használhatók. Minden más felhasználó email címe látható az adatbázisban, a jelszavuk **123456789**
