#### kmom02
Kmom02 är klar, vilken rolig uppgift det varit. Uppgiften bygger på objektorienterade koncept och konstruktioner. En 
av de mest basala konstruktionerna i objektorientering kallas för *inheritance*, arv, vilket precis som det låter 
möjliggör för en klass att ärva funktionalitet från andra klasser. I PHP görs detta genom nyckelordet *extends*:

```
class Child extends Parent {}
```

När man talar om arv brukar man säga att det som kännetecknar relationen mellan objekten är att objektet som ärver 
(barnet) är (*is a*) ett objekt av föräldraklassen. Barnet ärver alltså hela föräldern och har tillgång till samma 
metoder och attribut som föräldern, förutsatt att de inte är inkapslade genom nyckelordet *private*. Barnet kan 
utöver det lägga till eller ändra på funktionalitet som föräldern har. Arv används därför ofta när man vill 
expandera eller specialisera en klass. Enligt Liskovs ersättningsprincip ska objekt av föräldraklassen alltid kunna 
bytas ut mot objekt av barnklassen utan att programmets funktionalitet ändras.

En annan konstruktion som ofta används inom objektorienterad programmering kallas för komposition (*composition* på 
engelska). Det definieras som att ett objekt, barnet, "lever i" ett annat objekt, föräldern. Om föräldern dör 
(raderas) innebär det även att barn-objektet dör. Om man säger att arv beskriver en *"is a"*-relation beskriver 
komposition istället en *"has a"*-relation, där föräldraobjektet äger de barn som lever i den. Såhär kan det se ut i 
PHP: 

```
class Parent 
{
private Object $attribute;

public function __construct() {
    $this->$attribute = new Child();
    }
}
```

Ett exempel på komposition i verkliga livet skulle kunna vara att vi människor är uppbyggda av organ som hjärta, lungor 
osv. Om vi säger att vår kropp är föräldraobjektet skulle man kunna säga att våra organ ägs av den - dör kroppen slutar 
även organen att leva. 

När vi ändå är inne på kroppen - alla (eller i alla fall de allra flesta) människor föds med samma organ och 
funktioner. Om vi återigen ser på kroppen som ett objekt kan vi säga att en människa för att kunna överleva ska 
klara av vissa basala funktioner - exempelvis att hjärtat ska pumpa runt blod och att vi ska kunna andas. Om en mall 
som säger att dessa basala grejer behöver utvecklas inte fanns i vårt DNA hade människan förmodligen varit rätt illa 
ute. Vi kan faktiskt i objektorientering göra något motsvarande, något som kallas för *interface*. Det är just en mall 
som beskriver vilken funktionalitet, alltså vilka metoder, som måste finnas i ett objekt. Interfacet beskriver inte 
exakt hur metoderna ska implementeras, bara att de ska finnas. Interface kan med fördel användas för att få bättre 
uppdelning av ens kod samt när man behöver skapa olika klasser som är ersättningsbara med varandra. 

För att ytterligare modularisera ens kod kan man också använda något som kallas för *trait*. I många andra språk 
finns något som kallas för multipelt arv, *multiple inheritance*, vilket innebär att en klass kan ärva från mer än 
en klass på samma gång. Det finns dock inte i PHP utan man använder istället traits. Det är en bit kod som kan 
implementeras i en klass för att klassen ska få den funktionaliteten traitet använder, alltså ganska liknande hur arv
fungerar. Skillnaden är att medans en klass bara kan ärva från en annan klass kan flera traits implementeras i en 
klass och ett trait implementeras i flera klasser. Traits är bra att använda när man har kod som behöver användas i 
flera olika klasser och möjlighet för att slå ihop klasserna till en klass inte finns. 

De konstruktioner som beskrivs ovan har under kursmomentet använts för att skapa grunderna till ett kortspel. Mitt 
kortspel består av fyra klasser som delar namespace - Card, Deck, Player och Hand. Klassen Card representerar 
spelkorten och består i grunden bara av attribut som representerar rang och färg på korten samt en metod som hämtar 
dessa attribut. I Deck skapas en kortlek av Card-objekt, det finns alltså ett kompositionsförhållande med Deck som 
förälder och Card-objekten som barn. Försvinner kortleken försvinner även korten. Deck-klassen implementerar ett 
interface som definierar vilka metoder som måste finnas i klassen. Detta är metoder för att skapa, hämta, blanda och 
dra kort ifrån kortleken samt en som hämtar kortlekens längd. Det finns även en annan kortlek, Deck2. Denna klass ärver 
från Deck och lägger till två jokrar i kortleken.

Ett Player-objekt representerar en spelare. Player-klassen består av ett id och ett hand-objekt (även här komposition) 
samt metoder för att ge spelaren en ny hand och hämta spelarens hand och id. Hand-objekten skapas med en kortlek som 
argument. När handen sedan ska bli fylld med kort genom drawHand-metoden dras korten från Deck-objektet och flyttas 
till handen. Även om det är svårt att se med blotta ögat när man kollar på klassen finns alltså även i Hand ett 
kompositionsförhållande till Card, eftersom korten förflyttas från Deck till Hand och därefter *lever i* handen. 

Överlag är jag relativt nöjd med min implementation. Mina klasser såg ganska annorlunda ut innan jag började jobba 
med JSON-delen av uppgiften. Mina kort returnerade då en nollindexerad array med färg och unicode-koden för rangen 
på kortet utan större tydlighet. Jag hade låst in mig lite på att lösa uppgiften kan man säga, med ganska ful 
struktur som resultat. När jag såg hur JSON-objektet såg ut var jag tvungen att tänka om - jag ville att en utomstående 
skulle kunna läsa JSON-objektet med lätthet utan att behöva läsa min kod. Jag strukturerade därför om allt ifrån 
Card-klassen till templates och använde associativa arrayer för att tydliggöra vad man läser.

Det jag funderar på att förbättra i nästa kmom är att reducera mängden återanvänd kod. Jag funderar lite på om det 
går att komma runt att skriva i princip samma kod i CardGameController och CardJSONController, men är osäker på hur 
jag skulle göra det. Jag funderade på att använda traits men kände att det skulle leda till en otydligare 
kodstruktur. Just traits är något jag inte hittat användning för alls i detta kmom - kanske för att det är ett helt 
nytt koncept jämfört med de andra konstruktionerna vi gått igenom som jag skulle säga att jag är ganska bekväm med. 
I nästa kmom ska jag se om det kan finnas skäl att använda det.

Jag har inte gjort problemlösningsdelen av uppgiften och skriver därför inte om den här. 
