# Structure

## base

ITEMS (<u>id</u>, name, textureName)

CRAFTS (<u>id</u>, resultId#, item1Id#, item2Id#, item3Id#, item4Id#, item5Id#, item6Id#, item7Id#, item8Id#, item9Id#)

USERS (<u>id</u>, name, email, password)

## idees

- pour la cle primaire, soit on prend un id soit on peut mettre tous les items de la grille pour qu'il n'y ai pas de duplication possible

ex:

CRAFTSV2 (<u>item1Id#, item2Id#, item3Id#, item4Id#, item5Id#, item6Id#, item7Id#, item8Id#, item9Id#</u>, resultId#)

- pour les crafts non-positione lors de la creation du craft par l'api, possibilite de creer toutes les combinaisons possible

ex:

<img src='structure/Screenshot from 2023-11-11 18-10-34.png' width='100px'><br/>

devient:

<img src='structure/Screenshot from 2023-11-11 18-10-34.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-10-45.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-10-52.png' width='100px'>

<img src='structure/Screenshot from 2023-11-11 18-10-59.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-11-03.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-11-07.png' width='100px'>

<img src='structure/Screenshot from 2023-11-11 18-11-10.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-11-14.png' width='100px'>
<img src='structure/Screenshot from 2023-11-11 18-11-18.png' width='100px'><br/><br/>

⚠️ augmente la taille de la BDD et la complexite de l'algo d'importation des crafts

- pour les crafts dans l'inventaire 2*2, on peut prendre les crafts dont les items 3, 6, 7, 8 et 9 sont null

<img src='structure/Screenshot from 2023-11-11 18-19-31.png' width='100px'><br/>

ou alors avoir une table separee, mais duplique des donnees
