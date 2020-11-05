# item_management_demo
First copy this directory inside local server directory of LAMP/WAMP/XAMPP.

Directory item_management_api is setup on laravel 8. It is for api.
To setup this you must have composer in your computer.

go to directory /item_management_demo/item_management_api in command line then hit command composer update it will gonna update composer packages.

Create new database in mysql by name item_management.

open file /item_management_demo/item_management_api/.env file in editor configure databse credentials like below.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=item_management
DB_USERNAME=root
DB_PASSWORD=root

Now hit command in /item_management_demo/item_management_api/
"php artisan migrate"

Check your database, It must have some tables.

then open http://localhost/item_management_demo/item_management_api/
(PORT no. may also provide according to server LAMP/WAMP/XAMPP) url in browser if browser display webpage like this url https://prnt.sc/ve0tox means api set success fully.


++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Now setup frontend item_management_demo/item-management-vue have this code.
To run you must have install vue in your computer. If don't have install it from https://cli.vuejs.org/guide/installation.html link.

Node NPM also required to run this.
Follow this https://www.npmjs.com/get-npm link for install 

open command propt go to directory item_management_demo/item-management-vue then run command 
1. "npm update"
2. "npm run serve"

second command will give you a link to open in browser.

In item_management_demo/item-management-vue/src/HelloWorld line no. 79
const APIURL = "http://localhost/item_management_demo/item_management_api/";
Paste right link of api project to correct work api



