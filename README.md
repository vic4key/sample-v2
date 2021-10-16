# Sample

### Introduction
Sample is a template project for fast, simple, easy creating a web-site-app based on [MVC Design Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) & [RESTful API](https://en.wikipedia.org/wiki/Representational_state_transfer)

### License
Under the [MIT](LICENSE) license

### Keywords for features
  - Server / Client
  - [RESTful API](https://en.wikipedia.org/wiki/Representational_state_transfer) (Protected by JWT Authentication - Bearer Schema)
  - [JSON Web Token](https://jwt.io/) - (User-defined RSA private/public key file)
  - [MVC Design Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
  - PHP, HTML, JS, CSS, MySQL
  - [Flight micro-framework](http://flightphp.com/), [jQuery](https://jquery.com/), [Bootstrap](https://getbootstrap.com/), [Font Awesome](https://fontawesome.com/), [Swagger UI](https://swagger.io/), [Bootstrap Validator](https://bootstrap-validate.js.org/)
  - Based on one template page that meaning only design page content
  - Signing Up/In/Out via social network (GitHub, Google, Facebook - `required HTTPS`)

### Keywords for demo
  - Sign In / Sign Out to access protected APIs
  - Protected User APIs - Create/Get/Update/Delete
  - Test User APIs via Swagger UI

### Requirements
PHP 5.6 or greater

### Installation

1. Make sure `Apache` & `MySQL` service is running on your machine
2. Clone the project to `localhost` directory as a root-level `/`
3. Import the database file at `/database.sql` to your `MySQL`
4. Disable/Enable or define social network integration information at `/socials/defines.php` (opt - disabled as default)
5. Okay. Take a look the home page at [localhost](https://localhost/sample-v2), the demo page at [localhost/demo](http://localhost/demo), the basic account for testing is `test:123` or you can using your social network account

Note:
> To change the base path `/` to another such as a sub-level eg. `/example` we have to make the following changes:
>>  1. Open the `commons/defines.php` file and update the variable `$SUB_PATH` to `/example`
>>  2. Open the `demo.swagger.yaml` file and update the variable `basePath` to `/example`
>>  3. Open the `frontend\Sample.bsdesign` project and go to `Export > Export Settings` then update `Export Destination` and `Export Script` to the correspond path

>

> The demo files are started with the prefix `demo.*` and these are deletable eg. `demo.content.php, demo.swagger.js, etc`

### Contact
Feel free to contact via [Twitter](https://twitter.com/vic4key) or [Email](mailto:vic4key@gmail.com) or [Website](http://vic.onl/)

### Screenshots

![](screenshots/0.png?)
![](screenshots/1.png?)
![](screenshots/2.png?)
![](screenshots/3.png?)
![](screenshots/4.png?)
![](screenshots/5.png?)