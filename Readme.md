1. persitarea datelor despre nume companie, data inregistrare, cod TVA
2. folosire si rootare HTTP requests
3. securizare (orice metoda)
4. logare requesturi (orice metoda)
5. validare cod TVA firme folosind un serviciu extern

Voi crea acest microserviciu folosind MVC ca si 'design pattern' si voi incerca sa separ logica cat pot de mult folosing OOP.

Requesturile vor fi 'handled' de catre o clasa Router ce va invoca controllerul in cauza.

Pentru logat requesturi, cred ca cel mai simplu ar fi sa le scriu intr-un fisier, desi s-ar putea face si intr-o baza de date deci daca as fi avut mai mult timp as fi facut-o intr-o baza de date.

Pt securizare ma gandesc la validari de front-end cat si de backend(html escaping, sql injection, etc)

Datele vor fi salvate intr-o baza de date, intr-un singur tabel, desi cu siguranta as fi avut mai multe tabele si as fi facut legaturi intre ele.

De asemenea voi incerca sa fac requesturile de salvare printr-un 'API' deoarece mi se pare mai ok si fancy decat sa fac redirecturi din backend sau sa reincarc pagina.

Pt validarea codului tva, folosirea serviciului extern:
Am gasit un api foarte simplu si pot lua resultatul pur si simplu accesand link-ul cu 'file_get_contents' dupa ce este construit.
Ma voi folosi de resultat pentru a face validarea pentru VAT.

Pt autoload voi folosi composer.

Mai jos voi incerca sa explic flow-ul si structura proiectului pe masura ce creez aplicatia daca imi permite timpul:

    - config
        * aici vom avea initializa niste constante pentru a ne folosi de ele in proiect
        * fisierul de bootstrap pentru a incarca autoload-ul generat de composer + alte dependinte necesare pentru aplicatie
    - public
        * aici vom aveam fisierul 'index.php' in care vom include configul pentru a avea access peste tot la constantele create
        * tot in 'index.php' vom include si fisierul 'bootstrap.php'
    - src
        * aici vom imparti logica aplicatiei si acest folder va contine la randul lui alte foldere explicate in detaliu mai jos.
    - var 
        * aici putem adauga loguri si orice alte fisiere care sunt temporare
        * normal acest folder ar fi ignorat de git, dar il vom pastra pentru a urca si request-urile logate
    
#SRC:

1. Core:
Aici vom crea clasa principala 'Application' ce va fi initializata in 'index.php' pentru a 'porni' practic aplicatia si a resolva request-urile.

Application va avea un constructor ce va initializa 2 clase: Request si Router.
Request se va ocupa de parsarea url-ului si de adunarea datelor trimise de utilizator.

Request va fi trimis mai departe catre Router ca si dependancy injection, folosind instanta de Request pentru a verifica si rezolva(chemand un controller si trimitand mai departe datele acelui controller).

2. Network:
Request va fi initializat avand:
    * $data care va contine datele din $_GET, $_POST sau ce a fost trimis ca si 'json'.
    * url-ul parsat pentru a contine doar 'controllerul', 'metoda' si ce alti parametri au fost introdusi, f.ex:
        url = 'http://localhost/home/index/admin?checkUser=1&page=2, unde:
            * '?checkUser=1&page=2' va fi ignorat pentru ca datele se vor obtine cu '__seData()', deci nu avem nevoie acesti parametri
            * 'home' ar fi controller
            * 'index' ar fi actiunea
            * 'admin' ar fi parametru

    Asta ar fi durat ceva timp si nu cred ca avea rost asa ca am fortat controllerul sa fie 'Cotroller' si voi presupune ca metoda va fi primul element din url.    

3. Controller:
Avem un controller principal, care va fi o clasa abstracta deoarece nu va fi instantiat, ci doar extins de alte controllere.
In controllerul principal vom adauga cateva metode ce vor putea fi folosite in toate celelalte controllere care il extind + un constructor care din nou va fi mostenit de toate celelalte controllere pentru a avea acces la diverse instante ce pot fi folosite: request si view

4. Model:
    * Repository va fi un intreg tabel, acolo vor avea loc salvarile si query-urile
    * Entity va fi un rand specific dintr-un tabel(pt a-l putea 'mapa ca si un obiect')

5. Database:
    * fisierul 'tema_php.sql' va create baza de date si tabelul necesar.
    * La baza de date ne vom conecta cu PDO.

6. View: 
    * Pentru view pur si simplu vor crea o clasa care va fi instantiata si folosita de cotroller pentru a randa anumite fisiere din 'Templates'



