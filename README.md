# Lúdavató szavazó rendszer - Programmer Site Documentation

A küldönböző csalások elkerülése érdekében, a 2020-as évtől kezdve a Lúdavatón történő szavazás egy webes platformon fog történni. Ennek a platformnak a dokumentációját olvashatjátok el itt. Nagyon fontos hogy ez egy programozó oldali dokumentáció, azoknak, akik tovább szeretnék fejleszteni azt. A program felhasználói oldalról szóló dokumetáció rövidített változtata lejjebb is elolvasható, de a bővebb változat a program főoldalán van.

## Telepítés

Alapjáraton az oldal domain címe [ludavato.fazekas.hu](https://ludavato.fazekas.hu), viszont ha másik domain címre szeretnétek költöztetni a következő képpen tehetitek meg:  
**1.** Az oldal csak PHP Version 5.5.9-1ubuntu4.29 verzión lett tesztelve MySQL 8.0-ás adatbázis kezelővel, más verzión a működés nem garantált.  
**2.** Töltsd le a source fájlokat a Github repositoryról, és helyezd el a szerveren egy mappában.  
**3.** Menj bele a _qr_code/_ mappába, és hozz létre egy `final_images` és egy `qr_codes` mappát.  
**4.** Nevezd át az _EDIT_THIS_connect.php_ fájlt _connect.php_-ra.  
**5.** Nyisd meg a fájlt és töltsd ki a megfelelő adatokkal a `servername`, `username`, `password`, `db` és `page_url` változókat. A `servername` változóhoz a mysql szerver ip címét kell megadni. A `username` és `password` változók a bejelentkezési adataid a szerverre. A `db` változó a database-t takarja amiben a tábláidat fogod tenni. Végül pedig a `page_url` az a változó aminek tartalmát bevisszük a böngészőbe a főoldalon találjuk magunkat (például: http://www.duszmo.f.fazekas.hu/lavato/) **Nagyon fontos, hogy az _index.php_ ne szerepeljen a címben!**  
**6.** Nyisd meg az adatbázis kezelőt és hozz létre egy új database-t. (A nevét írd be a `db` változóba mielőtt elfelejted)  
**7.** Töltsd le az alább [sql fájlt (updatelni kell, nem a végleges)](https://www.mediafire.com/file/hqowwz4eg2px3nt/duszmo.sql/file) és importáld be az adatbázisodba!  
**8.** Nyisd meg az oldalt és látni fogod, hogy működik a home page és a szavazni is tudnál, ha lenne kódod.  
**9.** Az url mögé írd be, hogy login és átkerülsz a bejelentkezési felületre! Itt az _admin_, _password_ felhasználónév illetve jelszóval tudsz bejelentkezni.  
**10.** Ha mindent jól csináltál, meg kell jelennie egy Admin, Helyezések és Kijelentkezés gombnak a felső sávban.  
**11.** Utolsó lépésként változtasd meg a jelszavad az admin felületen (Felhasználók kezelése), hogy ne tudják feltörni a rendszert!

## Használat élesben

**1.** Először jeletkezz be a megadott felhasználó névvel és jelszóval  
**2.** Ha ezt megtetted meg kell jelenjen egy Admin gomb a felső sávban. Kattints rá!  
**3.** Kattints a kódok generálására, és generálj 500-at.  
**4.** Ezután lépj egyet vissza és exportáld a kódokat kártyákra. Ne aggódj ez el fog tartani néhány percig, ne zárd be az ablakot!  
**5.** Tömörítsd ki a zipfilet és nyomtasd ki a képeket A6-os méretben. (Ajánlott egy A4-es lapra többet is tenni)

## Program módosítás esetén

Pár alap információ:  
-Az összes PHP függvény a _snippets.php_ fájlban található  
-Az összes javascript függvény a _main.js_ fájlban található  
-Ha Egy MySQL-es függvényt szeretnél létrehozni a _connect.php_ előre deklaráltunk egy globális connection `$conn` változót

Mivel a program rengeteg küldönböző változót tartalmaz ezért nem nagyon tudom az össseset felsorolni sajnos, ezért ha bármilyen kérdésed vagy kérlek a duszmox@gmail.com email címen keress meg, de próbáltunk minél érthetőbb változó és fájl neveket adni, reméljük ki tudsz igazodni rajta :smiley:!
