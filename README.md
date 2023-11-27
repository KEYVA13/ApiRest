Readme

Nombre de los integrantes del grupo
Kevin Gonzalez Drake
Liliana Drake

Tematica del TP : Aplicacion de Inversiones

Una Inversion esta separada en Diferentes Planes(ID,Plan,Duracion,Precio,Porcentaje)

El sistema de esta pagina puede crear, modificar, eliminar o mostrar cualquier Plan .

Endpoints utilizados

* GET:    /api/planes                  - muestra todos los Planes registrados, ordenados y paginados
* GET:    /api/planes/:ID              - muestra una Plan especifico
* GET.    /planesFiltro                - filtra Plan por determinada condición
* PUT.    /planes/:ID                  - se modifica un plan especifico
* POST.   /planes                      - se agrega un plan
* DELETE. /planes/:ID                  - se elimina un plan especifico


Endpoints:

 Listado de todos los planes: Permite obtener un listado de todas los planes y sus características en formato de objeto JSON. HTTP METHOD: GET.

• Ejemplo para obtener todas los Planes registrados, ordenados y paginados: localhost/ApiRest/api/planes?sort_by=ID&order=DESC&page=1&per_page=3

• Ejemplo para obtener todas los planes filtrando por ID: localhost/ApiRest/api/planesFiltro?filtro=ID&tipo=2

• Ejemplo para obtener un plan : localhost/ApiRest/api/planes/3 (numero del plan)


• Ejemplo url para editar un plan : localhost/ApiRest/api/planes/3 (numero del plan a editar)
json ejemplo para editar:

{
        "Plan": "PLAN Kevin ",
        "Duracion": 360,
        "Precio": 10000,
        "Porcentaje": 100
}

• Ejemplo url para agregar un plan : localhost/ApiRest/api/planes
json ejemplo para agregar un plan:

{
        "Plan": "PLAN Kevin",
        "Duracion": 360,
        "Precio": 10000,
        "Porcentaje": 100
}

• Ejemplo url para eliminar un plan : localhost/ApiRest/api/planes/8


               
