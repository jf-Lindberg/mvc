### Pseudokod spelet 21
Context: Player has stayed. Bank does not know about the players hand.

```
INIT continue to true
INIT total to zero
WHILE continue is true
    READ valueOfCard
    SET total = total + valueOfCard
    IF total > 21
        BREAK game loop: player wins
    CASE    total   ACTION
            <17     hit (SET continue to true)
            ⩾17     stay (SET continue to false)
ENDWHILE
```
