# apiRest_Web2_Tudai
Trabajo práctico especial de la materia Web 2 de la carrera "Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas" de la Unicen, que consiste en el desarrollo de una api rest.    

### Server o url base
> http://localhost/apiRest_Web2_Tudai/api

## Recurso Rooms
> **Verbo**: `GET`    
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
    
| ------------------------------ |    
    
> Verbo: `GET`    
> URI: /rooms/:ID    
> Descripción: busca por el id la sala de escape alojada en la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la sala de escape deseada. Es un valor entero no menor a cero.  
`Ejemplo: /rooms/1` - Devuelve la sala de escape cuyo id sea 1.    
> Req Body: no posee.    
> Códigos de resp: 200 (OK), 404 (Not found)    
> Respuesta: se espera un JSON, que representa una sala de escape con las propiedades id, name, description, capacity, theme_id, difficulty, time, image.    
    
| ------------------------------ |    
    
> Verbo: `POST`    
> URI: /rooms    
> Descripción: añade una nueva sala de escape a la base de datos.
> Parámetros: no tiene    
`Ejemplo: /rooms` - inserta una sala de escape nueva en la base de datos, con los datos pasados en el body del request.    
> Req Body: se debe pasar un JSON con las propiedades name (valor de tipo texto), description (valor de tipo texto), capacity (valor de tipo entero > 1), theme_id (valor de tipo entero >= 0), difficulty (valor de tipo texto), time (valor de tipo entero > 0), image (valor de tipo texto).    
> Códigos de resp: 200 (OK), 401 (Unauthorized), 500 (Internal server error)    
> Respuesta: se espera un JSON, que representa la nueva sala de escape con las propiedades id, name, description, capacity, theme_id, difficulty, time, image.
        
| ------------------------------ |
    
> Verbo: `PUT`    
> URI: /rooms/:ID    
> Descripción: busca por su id y actualiza una sala de escape en la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la sala de escape deseada. Es un valor entero no menor a cero.    
`Ejemplo: /rooms/11` - actualiza la sala de escape con el id 11 en la base de datos, con los datos pasados en el body del request.    
> Req Body: se debe pasar un JSON con las propiedades name (valor de tipo texto), description (valor de tipo texto), capacity (valor de tipo entero > 1), theme_id (valor de tipo entero >= 0), difficulty (valor de tipo texto), time (valor de tipo entero > 0), image (valor de tipo texto).    
> Códigos de resp: 200 (OK), 401 (Unauthorized), 404 (Not found)    
> Respuesta: se espera un mensaje de texto detallando cómo resultó la solicitud.    

| ------------------------------ |    
        
> Verbo: `DELETE`    
> URI: /rooms/:ID    
> Descripción: busca por su id una sala de escape y la elimina de la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la sala de escape deseada. Es un valor entero no menor a cero.    
`Ejemplo: /rooms/11` - elimina la sala de escape con el id 11 en la base de datos.    
> Req Body: no tiene        
> Códigos de resp: 200 (OK), 401 (Unauthorized), 404 (Not found)    
> Respuesta: se espera un mensaje de texto detallando cómo resultó la solicitud.

## Recurso Themes
> Verbo: `GET`    
> URI: /themes    
> Descripción: obtiene todas las temáticas alojadas en la base de datos, algunos parámetros opcionales permiten paginar, ordenar o filtrar los resultados.    
> Parámetros: (query params, todos opcionales)    
`page` y `limit`: ambos parámetros son necesarios para paginar los resultados. A page se le debe pasar un entero mayor a cero, que representa el número de página deseado. Limit comprende mismo rango de valores  y representa la cantidad de temáticas que queremos limitar que muestre cada página. Estos parámetros son combinables con todos los demás.    
`Ejemplo: /themes?page=1&limit=3` - Devuelve la primera página de temáticas, limitando mostrar las tres primeras.    
`order`: este parámetro solo, ordena los resultados por la clasificación de la temática, según orden preferido. Los únicos valores posibles para este parámetro son "ASC" (orden ascendente) o "DESC" (orden descendente).
`Ejemplo: /themes?order=ASC` - Devuelve todas las temáticas ordenadas según su clasificación, de forma ascendente.    
`orderBy` y `order`: ambos parámetros son necesarios para poder ordenar las temáticas obtenidas según la preferencia del usuario. orderBy permite elegir porqué propiedad de las temáticas ordenar los resultados. Sus valores posibles son: name o classification. Mientras que order sólo puede ser "ASC" (orden ascendente) o "DESC" (orden descendente).    
`Ejemplo: /themes?orderBy=name&order=DESC` - Devuelve todas las temáticas ordenadas según su nombre, de forma descendente.
`filterBy` y `value`: ambos parámetros son requeridos para filtrar los resultados. A filterBy se le debe pasar una propiedad por la cual filtrar, cuyos valores válidos sólo pueden ser: name o classification. Mientras que a value se le debe pasar un valor de tipo texto no nulo codificado apto url en caso de utilización de símbolos.    
`Ejemplo: /themes?filterBy=classification&value=%2B13` - Devuelve todas las salas de escape cuya clasificación sea +13
> Req Body: no posee.    
> Códigos de resp: 200 (OK), 400 (Bad Request)    
> Respuesta: se espera un arreglo de JSONs, donde cada JSON es una temática con las propiedades id, name, classification.    
    
| ------------------------------ |    
    
> Verbo: `GET`    
> URI: /themes/:ID    
> Descripción: busca por el id la temática alojada en la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la temática deseada. Es un valor entero no menor a cero.  
`Ejemplo: /themes/1` - Devuelve la temática cuyo id sea 1.    
> Req Body: no posee.    
> Códigos de resp: 200 (OK), 404 (Not found)    
> Respuesta: se espera un JSON, que representa una temática con las propiedades id, name, classification.    
    
| ------------------------------ |    
      
> Verbo: `POST`    
> URI: /themes    
> Descripción: añade una nueva temática a la base de datos.
> Parámetros: no tiene    
`Ejemplo: /themes` - inserta una temática nueva en la base de datos, con los datos pasados en el body del request.    
> Req Body: se debe pasar un JSON con las propiedades name (valor de tipo texto), classification (valor de tipo texto).    
> Códigos de resp: 200 (OK), 401 (Unauthorized), 500 (Internal server error)    
> Respuesta: se espera un JSON, que representa la nueva temática con las propiedades id, name, classification.
    
| ------------------------------ |    
    
> Verbo: `PUT`    
> URI: /themes/:ID    
> Descripción: busca por su id y actualiza una temática en la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la temática deseada. Es un valor entero no menor a cero.    
`Ejemplo: /themes/2` - actualiza la temática con el id 2 en la base de datos, con los datos pasados en el body del request.    
> Req Body: se debe pasar un JSON con las propiedades name (valor de tipo texto), classification (valor de tipo texto).        
> Códigos de resp: 200 (OK), 401 (Unauthorized), 404 (Not found)    
> Respuesta: se espera un mensaje de texto detallando cómo resultó la solicitud.    

| ------------------------------ |    
        
> Verbo: `DELETE`    
> URI: /themes/:ID    
> Descripción: busca por su id una temática y la elimina de la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la temática deseada. Es un valor entero no menor a cero.    
`Ejemplo: /themes/2` - elimina la temática con el id 2 en la base de datos.    
> Req Body: no tiene        
> Códigos de resp: 200 (OK), 401 (Unauthorized), 404 (Not found)    
> Respuesta: se espera un mensaje de texto detallando cómo resultó la solicitud.    
    
## AUTH
> Verbo: `GET`    
> URI: /themes/:ID    
> Descripción: busca por su id una temática y la elimina de la base de datos.
> Parámetros: `:ID` se debe reemplazar por el ID de la temática deseada. Es un valor entero no menor a cero.    
`Ejemplo: /auth/token` - A través de una basic auth con los datos de nuestro usuario admin, genera un token para ser usado en las peticiones put, post y delete de nuestros recursos rooms y themes.   
> Req Body: no tiene        
> Códigos de resp: 200 (OK), 401 (Unauthorized), 404 (Not found)    
> Respuesta: se espera un mensaje de texto detallando cómo resultó la solicitud.  
