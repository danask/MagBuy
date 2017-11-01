![alt text](web/assets/images/logo.png)

# A full-featured Online Shop

## Basic User Functionality


- User friendly interface .
- Responsive design.
- Secure and reliable shopping.
- Pleasurable browsing of categorized products.
- Directly buy goods without intermediary service.
- Receive email about order status.
- Checking for most reliable goods rated by other consumers.
- Adding review for products.
- Adding and managing products in cart.
- Searching by name.
- Filter by rates, date, sales, top reviews, reviews count, price.
- Getting related products.
- Scrolling via infinity scroll.
- Following favorite products for discount.
- Receiving email for every change.
- Managing your account.
- Adding profile picture for reviews.
- Automatic image cropping.
- Restoring forgotten password by email.

## Basic Administrator Functionality

- User friendly admin panel.
- Adding super categories, categories, subcategories and specifiactions.
- Creating and editing products.
- Automatic image cropping.
- Adding discounts for certain products .
- User management and moderators.
- Managing reviews.

## Used technologies

- MySQL Database.
- Back-end by PHP.
- Front-end by HTML, CSS and JS.
- Libraries: Bootstrap, JQuery, Font Awesome.
- Others: FlexSlider, ImageZoom, Infinity Scroll W3 Slider, Google Fonts, Composer, PHP Mailer, Xampp, htaccess.

## Design patterns

- Front and Back-end division.
- Model View Controller (MVC).
- Data Access Objects (DAO).
- PHP Data Objects, Play Note PHP Object, constructors, classes.
- Folders categorized by namespaces.
- Singletons, autoloader.

## Documentation

- Executionable SQL script /Database SQL.sql to create MagBuy's database.
- The first registered user is Administrator - Role 3 in the database.
- Adminsitrator can change other users into moderators - from role 1 to role 2.
- Moderators can only manage products and orders.
- Every other user is with role 1.
- The forgotten password system uses tokken verification.
- Uploaded images must be below 5MB and one of these types - jpg, jpeg, gif, png. Images are cropped.
- Adding new product, 3 images must be defined.
- Editing product, 3 images must be defined or none.
- You must first create Super category, Category, Subcategory and specifications
before creating new product or the server will response with Error 500
- Have to create specifications for subcategory, before adding product.



