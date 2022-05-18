### kmom04
Nu har jag genomfört kmom04 som har fokuserat på testning. Vi har använt PHPUnit för att skriva testerna, det har 
gått bra. Det var ganska likt "unittest"-ramverket till Python som jag tidigare använt, så det kändes bekant. 
Dokumentationen var tydlig för PHPUnit och jag tyckte att det gick relativt fort att komma igång med att skriva 
tester. 

Att skriva tester är ju något utav en konst i sig och det kan vara lite svårt att veta exakt vilken nivå man ska 
lägga sig på när man skriver sin test-suite. Jag uppskattade verkligen rapporten som PHPUnit genererar där man kan 
se kodtäckning och CRAP-index. Mitt mål var att nå 100% kodtäckning för mina tester vilket jag även lyckades uppnå. 
För att nå dit behövde jag dock ändra lite i min kod. Jag märkte att jag hade gjort några lösningar som gjorde att 
flera klasser var alltför beroende av varandra. Bland annat hade jag en del onödig komposition. För att underlätta 
testning och göra klasserna mindre beroende av varandra har jag därför ändrat merparten av dessa förhållanden till 
aggregation istället. 

Jag har också ändrat vissa delar av hur vissa delar av spelet fungerar, till exempel hur poängen för spelaren och 
banken registreras och hämtas. Tidigare loopade metoden som hämtar poängen igenom handen och returnerade den totala 
poängen. I nuvarande version finns istället en medlemsvariabel som uppdateras för att hålla koll på poängen som 
returneras rakt av via tidigare nämnda metod. Flera sådana lösningar har ökat testbarheten och kändes faktiskt som 
enklare, tydligare lösningar med facit i hand.

En sak jag fortfarande har problem med är just testning i kombination med beroenden mellan klasserna. Även om jag 
under kursmomentets gång försökt att reducera starka kopplingar (hög coupling) mellan klasserna är det omöjligt att 
helt komma undan att vissa klasser är beroende av andra. Jag är osäker på om min kod håller måttet ur ett 
testbarhets- och "snygghets"-perspektiv. Min lösning för att testa beroende mellan klasser var att använda PHPUnits 
"mock"-funktionalitet.

Min åsikt gällande kopplingen mellan testbar kod och "snygg och ren kod" är att det finns ett visst förhållande 
mellan de två, men att de inte går hand i hand rakt av. För att få en kombination av snygg och testbar kod kan man 
behöva kompromissa på båda delar vilket väl hör till hantverket. Anledningen till att skriva kod är komplext är väl 
på sätt och vis just att man behöver väga fördelar och nackdelar med olika formuleringar mot varandra hela tiden. 
Från min erfarenhet har dock både ren kod och testbar kod något gemensamt och det är att den ska vara tydlig för 
människor att läsa. Om man inte förstår vad koden gör är den väldigt svår att testa och om koden är svår att förstå 
är den knappast "ren". 

Min TIL för detta kmom hör ihop med det jag är inne på ovan - precis som under tidigare kursmoment lär jag mig mer 
om hur många olika perspektiv man kan behöva tänka på under utvecklingsprocessen. Jag börjar känna av steg 2 av
Dunning-Kruger-effekten där självförtroendet sänks samtidigt som ens kunskapsnivå ökar. Min syn på det är inte 
negativ utan jag känner en ödmjukhet inför kommande läsår och blir sporrad att lära mig mer.
