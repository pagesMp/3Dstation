<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Backend -- Dimension3


En el backend he implementado las siguentes funcionalidades:

# LLAMADAS PÚBLICAS

Register:

POST https://dimension3-backend.herokuapp.com/api/register 

-> Datos a introducior : name, email, password y    company 

Login:

POST https://dimension3-backend.herokuapp.com/api/login

-> Datos a introducior : email y password

---

GET https://dimension3-backend.herokuapp.com/api/public/project/get/{num}

GET https://dimension3-backend.herokuapp.com/api/public/users/get/{num}

GET https://dimension3-backend.herokuapp.com/api/public/project/{projectId}/likes/{num}

GET https://dimension3-backend.herokuapp.com/api/public/profile/{id}

GET https://dimension3-backend.herokuapp.com/api/public/user/{id}/projects/get/all

GET https://dimension3-backend.herokuapp.com/api/public/project/{projectId}/add/view

GET https://dimension3-backend.herokuapp.com/api/public/project/get/{projectId}

GET https://dimension3-backend.herokuapp.com/api/public/projects/search/{title}



# LLAMADAS PRIVADAS

Profile:

GET https://dimension3-backend.herokuapp.com/api/register/api/profile/{id}

Update Profile:

POST https://dimension3-backend.herokuapp.com/api/profile/update/{id}

-> Datos a actualizar : name y email

Profile Logout:

DELETE https://dimension3-backend.herokuapp.com/api/logout

---

Create Project:

POST https://dimension3-backend.herokuapp.com/api/project/create

-> Datos a introducir : title, description, images, files, tags

Update Project:

POST https://dimension3-backend.herokuapp.com/api/project/update/{projectId}

-> Datos a actualizar : title, description, images, files, tags

Delete Project:

Delete https://dimension3-backend.herokuapp.com/api/project/udelete/{projectId}

---

Create Job:

POST https://dimension3-backend.herokuapp.com/api/job/create

-> Datos a introducir : title, description

Get Job de una empresa:

GET https://dimension3-backend.herokuapp.com/api/job/get/all/{id}

Get  all Jobs:

GET https://dimension3-backend.herokuapp.com/api/jobs/get/all

Get  JobById :

GET https://dimension3-backend.herokuapp.com/api/job/get/{jobId}

Update Job:

PUT https://dimension3-backend.herokuapp.com/api/job/update/{jobId}

-> Datos a actualizar : title, description

Delete JobById:

DELETE https://dimension3-backend.herokuapp.com/api/job/delete/{jobId}

---

Crear Like:

POST https://dimension3-backend.herokuapp.com/api/project/{projectId}/likes/add


Delete Project Likes:

DELETE https://dimension3-backend.herokuapp.com/api/project/{projectId}/likes/delete

---

Crear Follow:

POST https://dimension3-backend.herokuapp.com/api/profile/{userId}/follow/add


Delete Project Likes:

DELETE https://dimension3-backend.herokuapp.com/api/profile/{pusertId}/follow/delete