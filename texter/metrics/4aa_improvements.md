### Förbättringar

De förbättringar jag valt att göra baserat på analysen av PHPmetrics och Scrutinizer är följande:

#### **Skapa fler tester.**

Kodtäckningen för hela projektet är på bara 38%. Anledningen till det är att det inte finns några tester för något annat
än modellerna. Eftersom metoderna/routesen i controller-klasserna inte returnerar något traditionellt utan laddar
templates eller omdirigerar till andra routes. För att kunna testa controller-klasserna har jag letat efter andra
lösningar än asserts i PHPUnit och hittat *functional tests* genom Symfonys *WebTestCase*
-bundle. Med hjälp av det går det att testa att man får en viss respons, om routen gör en redirect och till och med göra
asserts kopplade till själva templaten.

Trots de funktionella testerna finns det vissa saker som har varit svårt att testa. Det gäller främst de grejer som är
beroende av databas-uppkoppling eller markdown-filer. Om jag förstått det rätt ska det gå att testa även dessa saker,
men det kändes som överkurs för den här kursen. Genom att skriva tester för controllers och entities har jag fått upp
kodtäckningen från 38% till 77%.

#### **Förbättra GameController.**

Den här klassen sticker ut när det kommer till dåliga mätvärden. Framför allt game-metoden har för stort ansvar med 
hög komplexitet och en CRAP på 90. Metoden hanterar formuläret, vad som händer när knapparna i formuläret klickas på,
flash-messages och att hämta och presentera data för spelaren/banken. Det är väldigt mycket för en metod. Jag har 
brutit ut det som är relaterat till formuläret som styr spelet i en egen metod, *gameForm*. Genom att göra detta och 
testa båda metoderna har Scrutinizer höjt betyget för game-metoden till ett A medan gameForm hamnar på ett B. Såhär 
såg det ut före ändringarna:

![report](images/scrutinizer_game.png)

Och såhär ser det ut efter ändringarna:

![report](images/game-post-edits.png)
![report](images/gameform-post-edits.png)


#### **Skapa en metod som skapar en JSON-response i CardJSONController.**
