Readme

Nombre de los integrantes del grupo
Kevin Gonzalez Drake
Liliana Drake

Tematica del TP : Aplicacion de Inversiones

Una Inversion esta separada en Diferentes Planes(ID,Plan,Duracion,Precio,Porcentaje)

El sistema de esta pagina puede crear, modificar, eliminar o mostrar cualquier Plan .

Endpoints utilizados

* GET:   /api/planes                  - muestra todos los Planes registrados
* GET:   /api/planes/:ID              - muestra una Plan especifico
* GET:   /api/planesXpaginadoYorden   - solicita una lista de entidades para paginar y ordenada.
* GET.   /planesFiltro                - filtra Plan por determinada condición
* PUT.   /planes/:ID                  - se modifica un plan especifico
* POST.  /planes                      - se agrega un plan
* DELETE./planes/:ID                  - se elimina un plan especifico               