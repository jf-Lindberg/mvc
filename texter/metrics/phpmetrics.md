### Rapportanalys PHPmetrics

Rapporten från PHPmetrics visar mätvärden på bland annat cyklomatisk komplexitet, cohesion och coupling. Den visar inte
code coverage. På översikten kan man se att det finns två "violations", att det är 1080 rader kod i applikationen och
att medelvärdet på cyklomatisk komplexitet för klasserna i applikationen är 3.95:

![report](images/phpm_overview.png)

Om man kollar på vilka violations som finns ser man följande:

![report](images/phpm_violations.png)

Vilket egentligen inte säger så mycket. Entity-paketet är autogenererat av Doctrine och verkar fungera bra. Att
Card-klassen har relativt hög risk för buggar går inte att göra så mycket med utan att veta mer om klassen.

Överlag ser det helt OK ut hittills, framför allt är den genomsnittliga cyklomatiska komplexiteten inom gränsen för
acceptabelt. Men medelvärdet berättar bara en liten del av historien, det kan finnas problemklasser som har hög
cyklomatisk komplexitet trots att medelvärdet är relativt lågt. Rapporten över komplexitet ger en mer detaljerad bild:

![report](images/phpm_complexity.png)

Klasserna med högst komplexitet är föga förvånande Controller-klasserna som sköter routesen i applikationen. Generellt
ligger alla klasser på rimliga nivåer med total komplexitet på 12 som mest. Metoderna verkar också vara relativt små
även om det verkar finnas en metod med komplexitet på 10 i GameController vilket står för 10/11 vägval i hela klassen.
Om man kollar på klassen verkar det vara play-metoden som är boven i dramat. Den sköter själva spelets logik och är
ganska stor. Det kan vara en idé att kolla på om det går att bryta ut mindre metoder ur den eftersom den har ett väldigt
stort ansvar i klassen. Rapporten visar även att Card-klassen som PHPmetrics varnade för inte verkar ha problem med just
komplexitet.

PHPmetrics generar även en rapport över klassernas LCOM. Den ser ut såhär:

![report](images/phpm_lcom.png)

Generellt ser rapporten bra ut och majoriteten av klasserna har en LCOM på 1, vilket indikerar att de har ett
ansvarsområde och att den data och de metoder som finns i dessa har god samhörighet. En klass sticker ut med hög LCOM,
det vill säga låg cohesion. Det är CardJSONController som har en LCOM på fyra. Anledningen till detta verkar vara 
att varje metod(route) returnerar en ny JSON-response, det finns alltså ingen sammankoppling mellan vad metoderna 
returnerar vilket gör att den statiska analysen tror att de har helt olika arbetsuppgifter. Det bör gå att få ner 
LCOM till 1 för klassen om man flyttar ut skapandet av responsen till en egen metod som man kallar på från routesen. 
Det är liten praktisk skillnad jämfört med hur det ser ut nu, men underlättar samtidigt om man av någon vill ändra 
på vilken typ av respons som ska returneras.

De andra klasserna som har LCOM över 1 är BookRepository, CreateBookType och BookController. I både BookRepository 
och CreateBookType är det konfigureringsmetoder som leder till lägre cohesion, det finns alltså gott skäl för det 
och behöver inte ändras. Efter en koll av BookController ser jag inte riktigt vad som kan orsaka högre LCOM, det kan 
ha att göra med att formulär skapas i flera metoder utan en gemensam metod som skapar dem. I det här fallet vore det 
dock opraktiskt att göra på annat sätt så jag kommer inte försöka åtgärda det.

Rapporten över coupling visar följande:

![report](images/phpm_coupling.png)

Det viktiga 

Det finns dock rapporter för både cohesion och coupling som går mer på djupet och kan hitta problem som inte syns i
översikten. Vi börjar med att kolla på cohesion genom mätvärdet LCOM:

COUPLING RIMLIGT PÅ CONTROLLERS

![report](images/lcom.png)


