### kmom06

Statisk kodanalys är the name of the game detta kmom! Det har varit intressant att jobba med verktyg som försöker leda
en i rätt riktning. Både PHPmetrics och Scrutinizer gick ganska fort att komma in i att använda. Jag gillade vyn 
över komplexitet i PHPmetrics rapport, det gav en bra översikt över vilka klasser och metoder som kunde vara 
problematiska och behöver kollas igenom. I Scrutinizer uppskattade jag nästan varenda rapport, jag tyckte mycket av 
informationen var relevant och välpresenterad. Vid första bygget hade jag 38% kodtäckning och en kodkvalitet på 9.86,
vilket jag genom mina åtgärder fick upp till 77% respektive 9.94. 

Jag tror absolut på att man kan använda rapporter, badges eller liknande för att påvisa en viss typ av kodkvalitet. 
Jag tänker främst på att det håller koll på att man följer vissa principer, håller nere komplexiteten i klasser & 
metoder och så vidare. Det är dock en liten del av vad kodkvalitet är, i alla fall för mig. Verktygen kan inte kolla 
hur lättläst koden är, ifall den är slimmad och logisk och andra mer subjektiva saker. Så jag tror inte man ska 
använda badges som ett kvitto på att ens kod är bra, utan snarare som ett tecken på att man följer en viss standard 
som *kan* innebära bra kod.

Min TIL för detta kmom är att jag lärt mig att det går att få ut en massa olika mätvärden ur ens kod, men att de 
inte betyder något om man inte vet vad man ska göra av dem. Precis som Mikael sagt i sina föreläsningar tror jag 
mycket på att använda de som en coach, men också försöka gå till botten med att förstå vad orsaken till de problem 
som verktygen visar är. 
