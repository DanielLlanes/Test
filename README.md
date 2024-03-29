## Controladores

### UserController

El controlador `UserController` gestiona las operaciones relacionadas con los usuarios en la aplicación.

**Métodos:**

- `users()`: Obtiene todos los usuarios de la base de datos y los devuelve en formato JSON.

- `show()`: Muestra un usuario específico según el ID proporcionado en la solicitud.

- `create()`: Crea un nuevo usuario con los datos proporcionados en la solicitud.

- `update()`: Actualiza un usuario existente con los datos proporcionados en la solicitud.

- `delete()`: Elimina un usuario según el ID proporcionado en la solicitud.

### CommentController

El controlador `CommentController` gestiona las operaciones relacionadas con los comentarios de los usuarios en la aplicación.

**Métodos:**

- `comments()`: Obtiene todos los comentarios de la base de datos y los devuelve en formato JSON.

- `show()`: Muestra un comentario específico según el ID proporcionado en la solicitud.

- `create()`: Crea un nuevo comentario con los datos proporcionados en la solicitud.

- `update()`: Actualiza un comentario existente con los datos proporcionados en la solicitud.

- `delete()`: Elimina un comentario según el ID proporcionado en la solicitud.

## Modelos

### User

El modelo `User` proporciona métodos para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la tabla de usuarios de la base de datos.

**Métodos:**

- `getUsers()`: Obtiene todos los usuarios de la base de datos.

- `getUserById($userId)`: Obtiene un usuario específico por su ID.

- `createUser($userData)`: Crea un nuevo usuario con los datos proporcionados.

- `updateUser($userId, $userData)`: Actualiza un usuario existente con los datos proporcionados.

- `deleteUser($userId)`: Elimina un usuario existente por su ID.

### Comment

El modelo `Comment` proporciona métodos para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la tabla de comentarios de la base de datos.

**Métodos:**

- `getAllComments()`: Obtiene todos los comentarios de la base de datos.

- `getCommentById($commentId)`: Obtiene un comentario específico por su ID.

- `createComment($commentData)`: Crea un nuevo comentario con los datos proporcionados.

- `updateComment($commentId, $commentData)`: Actualiza un comentario existente con los datos proporcionados.

- `deleteComment($commentId)`: Elimina un comentario existente por su ID.

## Clase Connection

La clase `Connection` proporciona una conexión a la base de datos utilizando PDO.

**Métodos:**

- `connect()`: Establece una conexión a la base de datos utilizando los parámetros definidos en la clase y devuelve el objeto PDO correspondiente.

## Clase Controller

La clase `Controller` proporciona métodos útiles para los controladores, como la carga de modelos y el envío de respuestas JSON.

**Métodos:**

- `model($model)`: Carga y devuelve una instancia del modelo especificado.

- `sendJsonResponse($statusCode, $data)`: Envía una respuesta JSON con el código de estado especificado y los datos proporcionados.

## Clase Model

La clase `Model` sirve como clase base para los modelos de la aplicación y proporciona una instancia de la conexión a la base de datos y una instancia de la clase `Query` para realizar consultas.

**Métodos:**

- `__construct()`: Inicializa la conexión a la base de datos y la instancia de `Query`.

## Clase Query

La clase `Query` proporciona métodos para ejecutar consultas SQL y recuperar resultados utilizando PDO.

**Métodos:**

- `query($query, $params)`: Prepara una consulta SQL con los parámetros especificados.

- `bind($parameter, $value, $type)`: Vincula valores a los parámetros de la consulta.

- `execute()`: Ejecuta la consulta preparada.

- `resultSet()`: Devuelve el conjunto de resultados de la consulta en formato JSON.

- `single()`: Devuelve una sola fila de resultados de la consulta en formato JSON.

- `rowCount()`: Devuelve el número de filas afectadas por la consulta.

## Clase Router

La clase `Router` maneja las rutas y las solicitudes HTTP entrantes, dirigiéndolas al controlador y la acción correspondientes.

**Métodos:**

- `get($url, $controllerAction)`: Registra una ruta para solicitudes GET.

- `post($url, $controllerAction)`: Registra una ruta para solicitudes POST.

- `put($url, $controllerAction)`: Registra una ruta para solicitudes PUT.

- `patch($url, $controllerAction)`: Registra una ruta para solicitudes PATCH.

- `delete($url, $controllerAction)`: Registra una ruta para solicitudes DELETE.

- `dispatch()`: Despacha la solicitud entrante al controlador correspondiente basado en la ruta y el método HTTP.

