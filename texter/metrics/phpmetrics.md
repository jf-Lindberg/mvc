### Rapportanalys PHPmetrics

Rapporten från PHPmetrics visar mätvärden på bland annat cyklomatisk komplexitet, cohesion och coupling. Den visar 
inte code coverage. På översikten kan man se att det finns två "violations", att det är 1080 rader kod i 
applikationen och att medelvärdet på cyklomatisk komplexitet för klasserna i applikationen är 3.95:

![report](images/phpm_overview.png)

Om man kollar på vilka violations som finns ser man följande: 

![report](images/phpm_violations.png)

Vilket egentligen inte säger så mycket. Entity-paketet är autogenererat av Doctrine och verkar fungera bra. Att 
Card-klassen har relativt hög risk för buggar går inte att göra så mycket med utan att veta mer om klassen.

Överlag ser det helt OK ut hittills, framför allt är den genomsnittliga cyklomatiska komplexiteten inom gränsen för 
acceptabelt. Men medelvärdet berättar bara en liten del av historian, det kan finnas problemklasser som har hög 
cyklomatisk komplexitet trots att medelvärdet är relativt lågt. Rapporten över komplexitet ger en mer detaljerad bild:

![report](images/phpm_complexity.png)

Det 
finns dock 
rapporter för både 
cohesion och 
coupling som går mer på djupet och kan hitta 
problem som 
inte syns i översikten. Vi börjar med att kolla på cohesion genom mätvärdet LCOM:

![report](images/lcom.png)


