#### kmom01

Läsperiod fyra är inledd och därmed även kursen MVC/OOPhp. Under läsperiod tre läste vi objektorienterad Python, där vi
byggt datastrukturer (länkade listor, binära sökträd, Trie) och webbplatser med hjälp av ramverket Flask. Med denna kurs
i ryggen känner jag mig bekväm med begrepp som klass, objekt, konstruktor, instansiering, medlemsattribut osv. Jag har
tidigare gillat att arbeta objektorienterat för jag upplever att det blir enklare att bryta ned problem i mindre
beståndsdelar. 

Efter att ha börjat med objektorientering i PHP går det att dra många paralleller till objektorienterad Python. 
Grunderna är desamma: för att bygga ett program på objektorienterat sätt är målet att dela upp det i mindre 
beståndsdelar. Dessa delar kallas *klasser*. Tanken med en klass är att man samlar data och beteenden på samma 
ställe i koden. Datan kallas för attribut och beteendena (funktionerna) kallas för metoder. En klass i PHP defineras 
såhär:

```
class Example {
    public $attribute;
    private $anotherattribute;
    
    public function example {
        return "{$this->attribute} and {$this->$anotherattribute}";
    }
}
```

En klass är en "mall" för att skapa ett *objekt*. Ett objekt av en viss klass kallas en *instans* av den klassen. 
För att skapa ett objekt använder man "new"-nyckelordet i PHP:

```
$object = new Example();
```

I kodexemplet kan man även se två andra koncept som är viktiga i objektorientering: inkapsling och $this. Inkapsling 
innebär att vi "gömmer" delar av objektet så att det inte går att hämta eller ändra på attribut publikt, dvs. från 
resten av programmet. Detta görs genom att definera attributet som privat. Man kan istället skapa publika metoder 
för att komma åt de attributen, dessa kallas getters och setters. *$this* är objektets sätt att referera till sig 
själv. När man hämtar attribut genom $this säger man till objektet att den ska kolla i sin egna data för att hitta 
vad attributet har för värde. 

Vi började doppa tårna lite i objektorienterad PHP i och med att vi skulle skapa en /me/-sida. För att bygga den har 
vi använt PHP-ramverket Symfony och templatemotorn Twig. Vi har tidigare under utbildningen använt Twig så det 
kändes bekant. Flödet Controller->Route->Template känns även det igen från arbete i Flask, Express m. NodeJS och den 
rena PHP vi skrev i Webtec. Jag har försökt att "känna" på hur kodbasen funkar och installerat några paket, 
exempelvis för att kunna skriva den här texten i markdown och ladda texterna efter varandra. 

När det kommer till artikeln "PHP The Right Way" finns det mycket information att ta till sig av som PHP-newbie.
Personligen använder jag helst liknande artiklar som uppslagsverk, därför har det i detta kmom varit intressant att 
läsa om dependency management, compiled templates och errors & exceptions. Vid senare kmoms kommer säkert andra 
delar vara intressanta istället.

Min TIL för detta kmom är att man kan köra en lokalserver via PHP direkt från terminalen. Jag har trott att XAMPP 
har varit ett måste för att få det att funka, mycket skönare att slippa det och sköta allt i terminalen istället.
