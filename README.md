<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Introducción

En el backend se han creado las siguientes rutas. 

A continuación se listan todas las llamadas, sus parámetros y requisitos.

# Público

## Registro

**POST** https://dimension3-backend.herokuapp.com/api/register 

> BODY -> _name, email, password, company_

## Inicio de sesión

**POST** https://dimension3-backend.herokuapp.com/api/login

> BODY -> _email, password_

## Admin

**DELETE** https://dimension3-backend.herokuapp.com/api/admin/user/delete/{userId}

> PARAMS {userId} -> identificador de usuario

**DELETE** https://dimension3-backend.herokuapp.com/api/admin/project/delete/{projectId}

> PARAMS {projectId} -> identificador de proyecto

## Proyectos

**GET** https://dimension3-backend.herokuapp.com/api/public/project/get/{num}

> PARAMS {num} -> número máximo de proyectos a obtener

**GET** https://dimension3-backend.herokuapp.com/api/public/project/{projectId}/likes/{num}

> PARAMS {num} -> número máximo de likes (relacional usuario-proyecto)

**GET** https://dimension3-backend.herokuapp.com/api/public/project/{projectId}/add/view

> PARAMS {projectId} -> identificador de proyecto

**GET** https://dimension3-backend.herokuapp.com/api/public/project/get/{projectId}

> PARAMS {projectId} -> identificador de proyecto

**GET** https://dimension3-backend.herokuapp.com/api/public/projects/search/{title}

> PARAMS {title} -> título de proyecto

## Usuarios

**GET** https://dimension3-backend.herokuapp.com/api/public/users/get/{num}

> PARAMS {num} -> número máximo de usuarios a obtener

**GET** https://dimension3-backend.herokuapp.com/api/public/profile/{id}

> PARAMS {id} -> identificador de usuario

**GET** https://dimension3-backend.herokuapp.com/api/public/user/{id}/projects/get/all

> PARAMS {id} -> identificador de usuario

# Privado (con autenticación)

## Perfiles 

**GET** https://dimension3-backend.herokuapp.com/api/register/api/profile/{id}

> PARAMS {id} -> identificador de usuario

**POST** https://dimension3-backend.herokuapp.com/api/profile/update/{id}

> PARAMS {id} -> identificador de usuario

> BODY -> _name, email_

**DELETE** https://dimension3-backend.herokuapp.com/api/logout

## Proyectos

**POST** https://dimension3-backend.herokuapp.com/api/project/create

> BODY: _title, description, images, files, tags_

**POST** https://dimension3-backend.herokuapp.com/api/project/update/{projectId}

> PARAMS {projectId} -> identificador de proyecto

> BODY: _title, description, images, files, tags_

**DELETE** https://dimension3-backend.herokuapp.com/api/project/udelete/{projectId}

> PARAMS {projectId} -> identificador de proyecto

## Ofertas de emplo

**POST** https://dimension3-backend.herokuapp.com/api/job/create

> BODY: _title, description_

**GET** https://dimension3-backend.herokuapp.com/api/job/get/all/{id}

> PARAMS {id} -> identificador de empresa

**GET** https://dimension3-backend.herokuapp.com/api/jobs/get/all

**GET** https://dimension3-backend.herokuapp.com/api/job/get/{jobId}

> PARAMS {jobId} -> identificador de oferta de empleo

**PUT** https://dimension3-backend.herokuapp.com/api/job/update/{jobId}

> PARAMS {jobId} -> identificador de oferta de empleo

> BODY: _title, description_

**DELETE** https://dimension3-backend.herokuapp.com/api/job/delete/{jobId}

> PARAMS {jobId} -> identificador de oferta de empleo

## Likes

**POST** https://dimension3-backend.herokuapp.com/api/project/{projectId}/likes/add

> PARAMS {projectId} -> identificador de proyecto

DELETE https://dimension3-backend.herokuapp.com/api/project/{projectId}/likes/delete

> PARAMS {projectId} -> identificador de proyecto

## Follows

**POST** https://dimension3-backend.herokuapp.com/api/profile/{userId}/follow/add

> PARAMS {userId} -> identificador de usuario

**DELETE** https://dimension3-backend.herokuapp.com/api/profile/{userId}/follow/delete

> PARAMS {userId} -> identificador de usuario

## RELATIONAL DB

![BD](img/db.png)