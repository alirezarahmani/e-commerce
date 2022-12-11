# E-Commerce App

# Introduction:
It's a very navie and super simple implementation of [CQRS](https://martinfowler.com/bliki/CQRS.html). For this I do not consider payment, shipments and, etc.
which I use [value objects](https://martinfowler.com/bliki/ValueObject.html) and php 8.1
# Auth:
For authentication, I use JWT.

# Restful API:

Products
<hr>


### Show Products
Get the details of all products.

**URL** : `/api/v1/products`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "ok",
            "price": 70,
            "stock": 40,
            "created_at": "2022-12-07T18:33:52.000000Z",
            "updated_at": "2022-12-07T18:34:43.000000Z",
            "brand": {
                "id": 1,
                "name": "ok",
                "created_at": "2022-12-07T18:33:52.000000Z",
                "updated_at": "2022-12-07T18:34:43.000000Z"
            }
        },
        {
            "id": 2,
            "name": "ddd",
            "price": 80,
            "stock": 1,
            "created_at": "2022-12-07T18:33:52.000000Z",
            "updated_at": "2022-12-07T18:34:43.000000Z",
            "brand": {
                "id": 1,
                "name": "ok",
                "created_at": "2022-12-07T18:33:52.000000Z",
                "updated_at": "2022-12-07T18:34:43.000000Z"
            }
        }
    ],
    "first_page_url": "http://localhost:8000/api/v1/products?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/products?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/v1/products?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

## Show Single Products

Get the details of a single products.

**URL** : `/api/v1/products/{id}`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "id": 1,
    "name": "ok",
    "price": 70,
    "stock": 40,
    "created_at": "2022-12-07T18:33:52.000000Z",
    "updated_at": "2022-12-07T18:34:43.000000Z",
    "brand": {
        "id": 1,
        "name": "ok",
        "created_at": "2022-12-07T18:33:52.000000Z",
        "updated_at": "2022-12-07T18:34:43.000000Z"
    }
}
```

## Add a new Products

Add a new product.

**URL** : `/api/v1/products/brand/{id}`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

**body example**:
```json
{
    "name": "test",
    "price": 10,
    "stock": 5
}
```
### Success Response

**Code** : `200 OK`


## Import Products

import products.

**URL** : `/api/v1/products-import`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

**body example**:
    post a file, with name file
### Success Response

**Code** : `200 OK`

## Delete a new Products

remove a new product.

**URL** : `/api/v1/products/{id}`

**Method** : `DELETE`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`



> Note: in order to add brands you need to import products. it will create brands.

<hr>

## Get Basket of current User

Get the details of basket.

**URL** : `/api/v1/baskets`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "id": 7,
    "user_id": 2,
    "price": 240,
    "created_at": "2022-12-07T18:33:52.000000Z",
    "updated_at": "2022-12-07T18:50:20.000000Z",
    "products": [
        {
            "id": 2,
            "name": "ddd",
            "price": 80,
            "stock": 1,
            "created_at": "2022-12-07T18:33:52.000000Z",
            "updated_at": "2022-12-07T18:34:43.000000Z",
            "pivot": {
                "basket_id": 7,
                "product_id": 2,
                "quantity": 3,
                "created_at": "2022-12-07T18:33:52.000000Z",
                "updated_at": "2022-12-07T18:34:43.000000Z"
            }
        }
    ]
}
```

## Add to basket

Add a product to basket.

**URL** : `/api/v1/baskets/product/{id}`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

## Remove From Basket

Remove from basket.

**URL** : `/api/v1/baskets/product/{id}`

**Method** : `DELETE`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

<hr>

## Create a new Order

add new order.

**URL** : `/api/v1/orders`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`


## Get current pending order details

get an order.

**URL** : `/api/v1/baskets/orders`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**Content examples**

```json
[
    {
        "id": 46,
        "user_id": 2,
        "whole_price": 480,
        "status": 0,
        "tax": 0,
        "created_at": "2022-12-09T11:32:57.000000Z",
        "updated_at": "2022-12-09T11:32:57.000000Z",
        "items": [
            {
                "id": 32,
                "name": "ddd",
                "brand": "ok",
                "quantity": 6,
                "price": 80,
                "product_id": 2,
                "order_id": 46,
                "created_at": "2022-12-09T11:32:57.000000Z",
                "updated_at": "2022-12-09T11:32:57.000000Z"
            }
        ]
    }
]
```


## Cancel an order

cancel an order.

**URL** : `/api/v1/orders-cancel/{id}`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`


## Finalize an order

done an order.

**URL** : `/api/v1/orders-done/{id}`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`
<hr>

## Register a user

register new user.

**URL** : `/api/v1/register`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**body example**:
```json
{
    "name": "test",
    "email": "test@test.com",
    "password": "test123456"
}
```
**Content examples**
```json
{
    "status": "success",
    "message": "User created successfully",
    "user": {
        "name": "test",
        "email": "testc@test.com",
        "updated_at": "2022-12-10T18:45:38.000000Z",
        "created_at": "2022-12-10T18:45:38.000000Z",
        "id": 3
    }
}
```

## Login user

login and get token.

**URL** : `/api/v1/login`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`

**body example**:
```json
{
    "email": "test@test.com",
    "password": "test123456"
}
```
**Content examples**

```json
{
    "status": "success",
    "user": {
        "id": 2,
        "name": "test",
        "email": "test@test.com",
        "email_verified_at": null,
        "created_at": "2022-12-07T10:42:59.000000Z",
        "updated_at": "2022-12-07T10:42:59.000000Z"
    },
    "authorisation": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2xvZ2luIiwiaWF0IjoxNjcwNjk3OTY3LCJleHAiOjE2NzA3MDE1NjcsIm5iZiI6MTY3MDY5Nzk2NywianRpIjoic1NvNEs5cGpqZDhCZEVodiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.J7WqKtIpfD6F4kt3d5p9T7ezRYsHcL0Jx2J6qKLtSeE",
        "type": "bearer"
    }
}
```

## Logout user

logout.

**URL** : `/api/v1/logout`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`


## Refresh Token

logout.

**URL** : `/api/v1/refresh`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

### Success Response

**Code** : `200 OK`
