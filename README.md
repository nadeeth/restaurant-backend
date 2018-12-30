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


## GraphQL queries ##

*To test GraphiQl Queries*
http://localhost:8100/dev/graphiql

*Pages*
query {
  readPages {
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
  }
}

*Menu Page and Menu*
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
          Price
          Description
          Image {
            Filename
          }
        }
      }
    }
  }
}

*Create an enquiry / contact form submission*
mutation {
  createEnquiry(
    Email: "john.doe@test.tes",
    Name: "John Doe",
    Phone: "022 7634567",
    Message: "Test Enquiry."
  ) {
    ID
    Email
    Name
    Phone
    Message
  }
}

*Read Members and Groups*
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