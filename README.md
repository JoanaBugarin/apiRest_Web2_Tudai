# apiRest_Web2_Tudai
Trabajo práctico especial de la materia Web 2 de la carrera "Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas" de la Unicen, que consiste en el desarrollo de una api rest.    

### Server o url base
> http://localhost/apiRest_Web2_Tudai/api

## Recurso Rooms
> Verbo: `GET`    
> URI: /rooms    
> Descripción: obtiene todas las salas de escape alojadas en la base de datos, algunos parámetros opcionales permiten paginar, ordenar o filtrar los resultados.    
> Parámetros: (query params, todos opcionales)    
Page y Limit: ambos parámetros son necesarios para paginar los resultados. A page se le debe pasar un entero mayor a cero, que representa el número de página deseado. Limit comprende mismo rango de valores  y representa la cantidad de salas que queremos limitar que muestre cada página.    
Ejemplo: /rooms?page=1&limit=3 - Devuelve la primera página de salas de escape, limitando mostrar las tres primeras.    
> Req Body    
> Códigos de resp    
> Respuesta

##Recurso Themes
