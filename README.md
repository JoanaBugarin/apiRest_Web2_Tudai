# apiRest_Web2_Tudai
Trabajo práctico especial de la materia Web 2 de la carrera "Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas" de la Unicen, que consiste en el desarrollo de una api rest.    

### Server o url base
> http://localhost/apiRest_Web2_Tudai/api

## Recurso Rooms
> Verbo: `GET`    
> URI: /rooms    
> Descripción: obtiene todas las salas de escape alojadas en la base de datos, algunos parámetros opcionales permiten paginar, ordenar o filtrar los resultados.    
> Parámetros: (query params, todos opcionales)    
`page` y `limit`: ambos parámetros son necesarios para paginar los resultados. A page se le debe pasar un entero mayor a cero, que representa el número de página deseado. Limit comprende mismo rango de valores  y representa la cantidad de salas que queremos limitar que muestre cada página. Estos parámetros son combinables con todos los demás.    
`Ejemplo: /rooms?page=1&limit=3` - Devuelve la primera página de salas de escape, limitando mostrar las tres primeras.    
`order`: este parámetro solo, ordena los resultados por la capacidad de la sala de escape, según orden preferido. Los únicos valores posibles para este parámetro son "ASC" (orden ascendente) o "DESC" (orden descendente).
`Ejemplo: /rooms?order=ASC` - Devuelve todas las salas de escape ordenadas según su capacidad, de forma ascendente.    
`orderBy` y `order`: ambos parámetros son necesarios para poder ordenar las salas obtenidas según la preferencia del usuario. orderBy permite elegir porqué propiedad de las salas de escape ordenar los resultados. Sus valores posibles son: name, description, theme_id, capacity, difficulty, image, time. Mientras que order sólo puede ser "ASC" (orden ascendente) o "DESC" (orden descendente).    
`Ejemplo: /rooms?orderBy=time&order=DESC` - Devuelve todas las salas de escape ordenadas según su tiempo, de forma descendente.
`filterBy` y `value`: ambos parámetros son requeridos para filtrar los resultados. A filterBy se le debe pasar una propiedad por la cual filtrar, cuyos valores válidos sólo pueden ser: name, description, theme_id, capacity, difficulty, image, time. Mientras que a value se le debe pasar un valor de tipo texto no nulo, en caso de que filterBy tenga valor name, description, difficulty o image. En caso contrario value debe ser un entero no menor a 1.    
`Ejemplo: /rooms?filterBy=capacity&value=5` - Devuelve todas las salas de escape cuya capacidad sea 5 personas.
> Req Body: no posee.    
> Códigos de resp: 200 (OK), 400 (Bad Request)    
> Respuesta: se espera un arreglo de JSONs, donde cada JSON es una sala de escape con las propiedades id, name, description, capacity, theme_id, difficulty, time, image.    
    
> Verbo: `GET`    
> URI: /rooms/:ID    
> Descripción: busca por el id la sala de escape alojada en la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la sala de escape deseada. Es un valor entero no menor a cero.  
`Ejemplo: /rooms/1` - Devuelve la sala de escape cuyo id sea 1.    
> Req Body: no posee.    
> Códigos de resp: 200 (OK), 404 (Not found)    
> Respuesta: se espera un JSON, que representa una sala de escape con las propiedades id, name, description, capacity, theme_id, difficulty, time, image.    

##Recurso Themes
