## Overview

...... 

## Installation ##

1. With Docker : https://github.com/nadeeth/php-dev-environment/tree/restaurant-backend

or

1. Checkout this repository.
2. run composer install
3. update .env file (copy and modify .env.example)
4. run dev/build?flush=1

## Deployment ##

Frontend : Build the front end, and copy the content of the frontend's build directory into the backend's public directory. And then update Page.ss with the new js and css file hashes. This is to be automated later. 



query {
  readMenuPages(URLSegment: "menu") {
    MenuTitle
    Title
    ID
    URLSegment
    Content
    ShowInMenus
    ClassName
    Banner {
      ID
      Title
      Name
      Filename
      File
    }
    MenuItems {
      edges {
        node {
          Title
        }
      }
    }
  }
}


query {
  readMembers {
    ID
    Email
    FirstName
    Groups {
      edges {
        node {
          ID
          Title
        }
      }
    }
  }
}