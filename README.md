This project is only avaible in swedish.

Alla får vara med
=================

Detta är ett projekt i Php där vi bygger något vackert tillsammans. Med vi menas alla som vill!

Läs mer på [webbprogrammering.ifokus.se](http://webbprogrammering.ifokus.se/discussions/4f1c23cbd3b4fd623b000d6f-proj-alla-far-vara-med?discussions-1)


Krav på kod
-----------

De enda krav som finns är att koden ska vara välskriven och formaterad i UTF-8.
Kommentarer ska finnas där koden inte är uppenbar.



FxS php-gallri
==============

För att förenkla hanteringen av användare och databas används ett php-galleri. Här kommer en kort beskrivning av hur det fungerar, hitta mer information i respektive klass som ligger i `includes/classes/FxS_[klassnamn].php`.


Hantera användare med $USER
---------------------------

Sessioner som hör ihop med inloggning får enbart hanteras med den globala variablen $USER. $USER är ett objekt av klassen `FxS_User`.

Registrera en användare:	`$USER->register($username, $password);` - Kan även trigga undantag, läs mer i klassfilen.
Logga in en användare:		`$USER->login($username, $password);` - Kan även trigga undantag, läs med i klassfilen.
Kontrollera om inloggad:	`$USER->is_logon()` - Retunerar TRUE om inloggad.


MySql frågor
------------

Alla mysqlfrågor måste gå genom den globala variablen $MYSQL

Läs mer i filen `FxS_Mysql.php`