## Customer Servicios:

- Store: Recibe un CustomerRequest con sus respectivas validaciones, ademas valida que el region y el commune ingresados existan y esten relacionados entre si, luego da de alta el customer, en caso de ser exitoso genera el log correspondiente y devuelve como respuesta un codigo 201

- Search: Recibe un CustomerSearchRequest, el filtro utilizado se usa para buscar por dni o mail del customer, ademas de validar que se encuentren en estado activo, en caso de no estar en un ambiente productivo se guarda el log correspondiente. Luego devuelve como respuesta una coleccion de Customer resource

- Destroy: Recibe un CustomerDeleteRequest, busca el customer por el dni recibido y en caso de estar en un estado distinto a activo responde un 400 aclarando que el registro no existe, luego le cambia el status del customer por 'trash' y genera el log correspondiente. En caso de ser exitoso devuelve como respuesta un codigo 204