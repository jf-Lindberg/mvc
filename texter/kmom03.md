### kmom03
Under detta kursmoment har jag modellerat och implementerat kortspelet 21. Inledningsvis byggde jag ett 
flödesdiagram och skrev ned pseudokod för att beskriva delar av spelet. Flödesdiagrammet beskriver hur en spelomgång 
inleds fram till att omgången lämnas över till banken/datorn och pseudokoden tar vid efter det, den beskriver hur 
datorn tar ett beslut om att stanna eller dra ett kort till. Båda metoderna har positiv inverkan ur det avseendet 
att tänkandet runs ens kod blir mer strukturerad. I just den här uppgiften upplevde jag inte att problemlösningen 
var så pass avancerad att det gav en stor hjälp, men oavsett är det bra att få övning i att använda 
problemlösningsverktyg. Om man har ett problem som man är abstrakt eller svårt att visualisera är det bra att kunna 
ha olika strategier för att hjälpa till i processen. 

Under implementationen av uppgiften har jag försökt att tänka på SOLID-principerna. Jag har omstrukturerat betydande 
delar av klasserna från tidigare kursmoment för att reducera coupling och se till att klasserna har ett tydligt 
syfte. En del i detta blev att ta bort den Hand-klass som fanns i tidigare implementation av spelet, då jag kände 
att den array som representerar handen hör samman med spelaren (Player) snarare än att behöva vara en egen klass. 
För att skapa spelet behövde jag lägga till sätt att kontrollera spelflödet vilket jag gjort genom Game-klassen. När 
man skapar ett objekt av klassen behöver man skicka med en spelare, en bank och en kortlek. Klassen håller koll på 
spelets state och låter spelarna dra fler kort så länge reglerna följs.

För att skapa en "Bank" gjorde jag en egen klass som ärver ifrån Player-klassen. Anledningen till detta är att de i 
grunden ska kunna göra samma sak - hantera sin korthand. Banken har dock ytterligare en metod för att avgöra om den 
ska dra eller inte.

Överlag är jag hyfsat nöjd med koden i kursmomentet men det har samtidigt varit ett väldigt ögonöppnande kursmoment. 
Efter föreläsningarna blev jag intresserad av att läsa mer om SOLID och kodstruktur överlag och en sak som är säker 
är att jag har väldigt mycket kvar att lära. Det är något vackert över hur enkel och tydlig kod skriven av erfarna 
utvecklare kan vara. Det känns utmanande och kul att ha blivit introducerad mer "på allvar" för den aspekten av 
mjukvaruutveckling. Jag försöker applicera MVC-tänket så mycket det går, men förstår att jag förmodligen skulle 
kunnat flytta över en del av koden i controllers till model-delen.

När det kommer till just MVC och hur man ska tänka kring det tycker jag Symfony och Twig är en bra kombination för 
att lära sig. Efter att ha jobbat med det några kursmoment känns det ganska naturligt, sättet Symfony hanterar 
routes på och enkelheten i Twigs templating är bra hjälpmedel för att kunna fokusera på "the big picture".

Min TIL för detta kmom är att det finns enormt mycket kvar att lära om hur man skriver kod. Att förstå 
grundläggande konstruktioner och hur man löser problem är bara en liten del av vad det innebär. Det är minst lika 
viktigt att ens kod är läsbar för andra och att den är lätt att underhålla. Det är något jag tar med mig framåt.
