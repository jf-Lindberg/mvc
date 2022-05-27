#### Introduktion - De fyra C'na (Coverage, Complexity, Cohesion, Coupling)
Analyserna på denna sida kommer bygga på "de fyra C'na" vilket är en term för fyra mätvärden som är bland de 
vanligaste att kolla på när man utför statisk kodanalys. Mätvärdena har gemensamt att orden som beskriver dem alla 
börjar på C på engelska. Dessa är:

##### Coverage
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

##### Complexity
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

##### Cohesion
Kan skrivas som samhörighet på svenska, det vill säga till vilken grad klassens data och beteenden hör ihop.

##### Coupling
Kan skrivas som koppling på svenska. Beskriver hur starka beroenden som finns kopplade till en klass.

- Flytta ut formulär från GameController till en egen Route
- Testa mera
- Gå mer på modellens STATE snarare än att hantera state i controllern
- 
