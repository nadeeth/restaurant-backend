## Overview

...... 

## Installation ##

1. With Docker : https://github.com/nadeeth/php-dev-environment/tree/restaurant-backend

or

1. Checkout this repository.
2. run composer install
3. update .env file (copy and modify .env.example)
4. run dev/build?flush=1


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
    ShowInFooterMenu
    ClassName
    Banner {
      ID
      URL
      Title
      Name
      Filename
      File
    }
  }
}

*Home Page*
query {
  readHomePages(URLSegment: "home") {
    MenuTitle
    Title
    ID
    URLSegment
    Content
    ShowInMenus
    ClassName
    Banner {
      ID
      URL
      Title
      Name
      Filename
      File
    }
    Background {
      ID
      URL
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
      URL
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
          Category {
            Title
          }
          Image {
            URL
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

*Create/Update Orders - Check Order Model for all the Order Statuses, ommit ID whne creating*
mutation {
  createOrder(
    ID: 2
    Email: "john.doe@test.tes",
    Name: "John Doe",
    Phone: "022 76345677",
    PickUpTime: "Date",
    Message: "Test Order",
    Status: "CustomerConfirmed"
    Total: 0,
    Tax: 12.5,
    Discount: 10,
    NetTotal: 0,
    Items: "[{'Title':'ItemOne','Price':'14.50','Qty':2},{'Title':'ItemTwo','Price':'3.50','Qty':1}]"
  ) {
    ID
    Email
    Name
    Phone
    PickUpTime
    Message
    Status
    Total
    Tax
    Discount
    NetTotal
  }
}

*Create Order Items*
mutation {
  createOrderItem(
    OrderID: 2,
    Title: "Pasta Salad",
    Price: 8.50,
    Qty: 2
  ) {
    ID
    Title
    Price
    Qty
  }
}

*Delete Order Items*
mutation {
  deleteOrderItem(
    ID: 1
  ) {
    ID
    Title
    Price
  }
}

*Read Orders*
query {
  readOrders(Email: "john.doe@test.tes") {
    ID
    Name
    Email
    Phone
    PickUpTime
    Status
    Total
    Tax
    Discount
    NetTotal
    OrderItems {
      edges {
        node {
          Title
          Qty
          Price
        }
      }
    }
  }
}

*Read SiteConfig*
query {
  readSiteConfig {
    Title
    Tagline
    Logo {
      ID
      URL
      Title
      Name
      Filename
      File
    }
    OrderTax
    OrderDiscount
    FooterText
    OpenTime
    CloseTime
    Facebook
    Instagram
    Twitter
    YouTube
  }
}

## User Roles ##
TODO : Document the user roles and configuration 

## CORS ##
TODO : Document CORS configuration.