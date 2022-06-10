### Scrutinizer

Rapporten från Scrutinizer visar mätvärden för bland annat coverage, komplexitet och CRAP. Jämfört med PHPmetrics går
det att gå in lite mer specifikt på vilka metoder som har hög komplexitet/CRAP samt se koden inklusive kodtäckning i
själva rapporten. Sammanfattningen på startsidan av Scrutinizer ser ut såhär:

![report](images/scrutinizer_overview.png)

Scrutinizer verkar alltså tycka att koden ser helt okej ut, men att vissa problemområden ändå finns. Kodtäckningen är
också väldigt låg. För att identifiera vilka klasser eller metoder som Scrutinizer tycker är problematiska går det att
kika på "code"-rapporten där man kan få en överblick över vad för betyg olika koddelar får. Där går det att gå in på 
"hot spots" för att se de sämst rankade klasserna och metoderna. För den här applikationen ser den rapporten ut såhär:

![report](images/scrutinizer_hotspots.png)

Samtliga klasser har fått betyget A av Scrutinizer, toppen! Men på metodsidan verkar det finnas några man skulle 
kunna göra lite bättre. Föga förvånande är det även här game-metoden i GameController-klassen som spökar. När man 
kollar på datan för just den metoden säger Scrutinizer följande:

![report](images/scrutinizer_game.png)

Man kan avläsa att game-metoden är komplex med många olika paths. Som tidigare nämnt är det här en stor metod som 
bär mycket ansvar i klassen. Metoden har dessutom inga test. Den kommer tittas närmare på senare. Den andra metoden 
som har under A är metoden unicode. Den får lägre betyg för att den är lång, men är i själva verket inte särskilt 
komplicerad. Den består av en lång array som mappar en sträng som representerar ett spelkort till unicode-format. 
Det går med andra ord inte att göra så mycket åt längden så länge unicode ska användas på webbplatsen.

Man kan även se i detalj vilka klasser som har låg respektive hög kodtäckning:

![report](images/scrutinizer_coverage.png)

Rapporten visar att alla modeller har 100% kodtäckning, men att tester saknas för controllers och entities. Det kan 
alltså vara en god idé att kika på hur man skulle kunna testa andra delar av koden än modellerna.
