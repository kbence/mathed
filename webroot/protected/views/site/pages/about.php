<style>
h1 {
	color: #4682BF;
	font: italic bold 30px Georgia, serif;
}

#index_style {
	
	color: #4682B4;
	font: italic bold 14px Georgia, serif;
    position: relative;
    right: -10%;
	width: 80%;
}
</style>

<H1 align="center">Portál bemutatása</H1>

<div id="index_style">
	<p align="justify">
		<?php print 
"Regisztráció\n
A felület lehetőséget ad új felhasználóként regisztrálni a rendszerbe.\n
Ehhez felhasználó nevet, emailcímet, valamint jelszót kell megadni, majd a “Register” gombra kattintva a felhasználói profil létrejön a rendszerben.\n
\n
\n
Login\n
\n
A Login felület a felhasználók beléptetését szolgálja a rendszerbe.\n
    Csak előzetesen regisztrált felhasználóknak van módja a MathEd rendszerbe belépni, a regisztráció során megadott felhasználónév-jelszó párossal. \n
\n
A rendszer jelzi, ha a felhasználónév, vagy a jelszó nem megfelelő.\n
\n
\n
Editor\n
Dokumentumtár\n
    A Dokumentumtár lehetőséget ad a korábban eltárolt dokumentumok megnyitására -a kiválasztott dokumentummal egy sorban lévő “Edit” gomb segítségével-, valamint új dokumentum hozzáadására, a “Create new” gomb segítségével. A rendszerbe belépett felhasználó csak az általa létrehozott dokumentumokat látja megjelenni a listában.\n
\n
Szerkesztő felület\n
A szerkesztő ablak három fő részre oszlik. \n
Bal oldalon, zölddel jelölten maga a forráskód bevitelére, szerkesztésére szolgáló felület található.\n
Jobb oldalon, pirossal keretezve az előnézet helyezkedik el.\n
Az sárgával jelölt területen a kommentálásra szolgáló beviteli mező, valamint a korábbi kommentek megjelenítésére szolgáló felület helyezkedik el.\n
\n    
\nElőnézet
\nA dokumentum előnézetét az Editor ablak felső részén elhelyezkedő “Save & Preview” gomb segítségével lehet frissíteni. Ekkor a rendszer a forráskód változásait is menti.
\n
\n
Comment felület\n
A kommentek írására, megjelenítésére szolgáló eszköz a felhasználóknak nyújthat segítséget azzal, hogy a megosztott dokumentumok készítése során egymás munkáját interaktívan tudják segíteni. A felület alsó részén szövegbeviteli mezőbe írható egy új komment, feljebb a korábbi megjegyzések olvashatók, időbélyegzővel, valamint a kommentelő felhasználónevével ellátva.\n"
		?>
	</p>
</div>

<p align="center">
	<img src="/images/example.jpg" alt="" height="75%" width="75%" >
</p>