### Introduktion
Analyserna på denna sida kommer bygga på "de fyra C'na" vilket är en term för fyra mätvärden som är bland de 
vanligaste att kolla på när man utför statisk kodanalys. Mätvärdena har gemensamt att orden som beskriver dem alla 
börjar på C på engelska. Dessa är:

#### Coverage
Code coverage är relaterat till testning och går att översätta till "kodtäckning" på svenska. Det mäts i procent och 
har att göra med hur stor andel av koden som testas. Med andra ord - om alla rader i kodbasen testas av enhetstester 
kommer coverage vara på 100% och om det inte finns några tester alls kommer den vara på 0%.

Detta mätvärde ger en indikation på hur seriöst programvaran testas. Teoretiskt borde hög coverage innebära att 
programvaran mindre sannolikt har buggar. En hög coverage indikerar också att koden är testbar vilket borde betyda 
att den i alla fall logiskt är förståelig. Låg coverage *kan* vara en indikator på att koden är osäker eftersom 
utvecklaren förlitar sig på sin egen bedömning när denne gör ändringar vilket *kan* vara en faktor som leder till 
defekter i koden. Något som är viktigt att nämna är att även om hög coverage generellt är bra så ger det inga 
garantier för något. Främst är det viktigt att tänka på att tester bara kan testa kod som finns. Om utvecklaren har 
missat att tänka på vissa fall (exempelvis glömt att kolla för null-värden eller liknande) vid både utveckling och 
testning kommer 100% coverage inte betyda något när det händer.

#### Complexity
Complexity eller cyclomatic complexity är ett mätvärde som precis som det låter har att göra med hur komplex delar 
av koden är, exempelvis funktioner/metoder eller klasser. Det definieras av antalet "vägar" koden kan ta i en given 
bit kod. En väg definieras i det här fallet som något som är beroende av något typ av villkor - alltså villkorssatser 
(if/else, switch) och loopar (for, while, foreach). Komplexiteten ökar linjärt med 1 per sådan konstruktion, medans 
sådant som sker **varje** gång koden körs, utan villkor, inte höjer komplexiteten.

Det är en god idé att försöka hålla enskilda funktioner eller metoders cyklomatiska komplexitet till ett minimum. En 
riktlinje brukar vara att en metod inte ska överstiga en komplexitet på 10. Om detta sker och det inte är möjligt 
att reducera komplexiteten utan att tappa funktionalitet går det att lösa genom att exempelvis lyfta ut kodsnuttar med 
hög komplexitet till egna metoder, vilket leder till bättre separation i koden och enklare testning. 

Gällande just testning ökar betydelsen av tester ju högre komplexitet en applikation har. Det finns ett mätvärde som 
kollar på just den relationen. Det förkortas CRAP och står för *change risk anti-patterns*. CRAP beräknas på följande 
sätt:

```
Låt m vara en metod
Låt CC(m) vara cyklomatisk komplexitet av m
Låt U(m) vara andelen av m som inte är täckt av enhetstester

CRAP(m) = CC(m)^2 * U(m)^3 + CC(m)
```

En hög CRAP-score indikerar alltså att ens kod är...ja, skit. Om en metod har hög CRAP indikerar det att den 
antingen är för komplex, inte är tillräckligt testad eller en kombination av båda. Det är en bra indikator på 
balansen mellan komplexitet och tester. Generellt bör en hög komplexitet vägas upp med hög coverage. 

En nackdel med att använda komplexitet som mätvärde är att det visar en ganska begränsad bild av just komplexiteten 
av en applikation. Mätvärdet kollar bara på hur många vägar som koden kan ta, inte vad dessa vägar består av. Rent 
teoretiskt skulle alltså en metod som har ett switch-statement med fem case där varje case printar 'a', 'b', 'c', 
'd', 'e' som mer komplext än ett if/else som kallar på massor av olika metoder. Det är därför viktigt att inte 
stirra sig blind på bara komplexitet eller CRAP utan ta andra mätvärden i beaktning och göra en helhetsbedömning.

#### Cohesion
Detta är ett mätvärde som man kan översätta till ungefär "samhörighet" på svenska. Precis som det låter är det en 
indikator på hur kod hänger ihop - mer specifikt hur nära sammankopplad koden i en klass är. Hög cohesion innebär 
att klassen gör många saker (har flera ansvarsområden), medan låg cohesion betyder att klassens data och beteenden 
(metoder) är tight sammankopplade. Hög cohesion indikerar alltså bland annat att koden bryter mot single-responsibility 
principle. Kod med låg cohesion är mer robust och mer logisk för de som ska läsa den, vilket underlättar felsökning 
och minskar risken för technical debt.

Cohesion kan också skrivas som LCOM vilket står för **L**ack of **Co**hesion in **M**ethods.

#### Coupling
Beroende eller *kopplingar* mellan klasser går att mäta och kallas för *coupling*. Det finns två olika typer av 
coupling - *afferent coupling* eller och *efferent coupling*. Afferent coupling beskriver inkommande kopplingar, det 
vill säga hur många andra klasser som är beroende av en given klass. Efferent coupling beskriver utgående kopplingar,
alltså vilka klasser en given klass är beroende av.

Att mäta efferent eller afferent coupling i sig är inte särskilt intressant eftersom det inte berättar någon 
särskild historia om koden. Klasser kommer alltid vara beroende av andra klasser. Men kombinationen av de båda 
mätvärdena kan berätta något om stabiliteten på koden. *Instability* mäts enligt följande uträkning:

```
Ce = efferent coupling (utgående kopplingar)
Ca = afferent coupling (ingående kopplingar)

Ce / (Ce + Ca)
```

Eftersom detta är en andelsberäkning kommer resultatet vara mellan 0 och 1, där 1 är en väldigt instabil klass och 0 
är en stabil klass. Vad detta i praktiken innebär är att en klass i isolation är stabil om den har många *ingående* 
kopplingar utan att ha några utgående kopplingar, eftersom 0 / 0 + x är 0. En klass blir mer och mer instabil ju 
fler utgående kopplingar den har. Det finns en logik i det resonemanget, eftersom ingående kopplingar egentligen 
inte påverkar funktionaliteten av just den klassen man analyserar. Utgående kopplingar är med andra ord boven och 
man bör vara vaksam ifall en klass instabilitet blir för hög. Samtidigt är det ibland inte praktiskt att undvika att ha 
många utgående kopplingar om man har exempelvis en controller-klass. Så länge man är medveten om och har ett skäl för 
instabiliteten kan det alltså vara acceptabelt att ha hög instabilitet på någon enstaka klass i en applikation, men 
om för många klasser är beroende av andra är det ett symptom på kod som skulle kunna förbättras. 

EC vs AC (efferent/afferent)

Kan skrivas som koppling på svenska. Beskriver hur starka beroenden som finns kopplade till en klass.

- Flytta ut formulär från GameController till en egen Route
- Testa mera
- Gå mer på modellens STATE snarare än att hantera state i controllern
- Flytta rena card-paths till en egen controller för att göra de mindre
