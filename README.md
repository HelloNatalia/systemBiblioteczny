# 📚 Library management web application

<img src="https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/index-client.PNG"/>


## 🔍 Project Overview

This application was created to **manage library tasks**. It is separated into public (client side) and internal (library) side. 

<br>

### Internal Side - side managed by employees - the ❤️ of the application

The backend part is intended to be used by library employees. There are many functions to create, edit, manage, etc. all important information.
An employee has own admin account on the application and can manage books (see, create, edit, delete, borrow to the reader), borrows (see, create, extend the deadline, settle cash arrears), readers (create, edit, see borrowed books), can also see reports like all borrows, returns, the status of books in the library. 


### Public Side - client side

This part enables a client to signup and login by 'reader ID'. Thanks to that the logged-in user has access to his borrowed books, can see how many days are left to the deadline, and what's importantly, can extend the deadline online. 

Of course, on every page is a possibility to search for a specific record with **autocomplete forms**, there are also sorting options for many data.

<br>

### 🔔 Important pages overview
<br>

- **Books**

The main function here is to show all books that the library has and how many and which books are available to borrow. 
The possibilities distinctive for the internal side are functions like creating, editing, deleting, and borrowing selected book.


<img src="https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/ksiazki-index-admin.PNG" style="width: 600px"/>   <img src="https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/ksiazka-karta-admin.PNG" style="height: 320px"/>

<br>

- **Authors**

Shows all authors of all the books in the library, and when you click selected author, it will show a list of his/her books.

<img src="https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/autorzy-admin.PNG" style="width: 700px"/>

<br>

- **Borrows**

Shows all active borrows with important data, records after the deadline are highlighted in red. There are options to create a new borrow, settle cash arrears, extend the deadline (only if certain conditions are met), and end the borrow.

<img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/wypo%C5%BCyczenia-admin.PNG style="width: 700px"/>

<br>

- **Readers**

Shows all readers registered in the library, when you click on the selected reader, the list of borrowed books will show. Every showed book here has two options: extend the deadline and end borrow.

<img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/czytelnicy-admin.PNG style="width: 300px"/>   <img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/czytelnik-admin.PNG style="width: 300px"/>   <img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/czytelnik-admin2.PNG style="width: 300px"/>

<br>

- **Receivables**

Here are shown only these active borrows that are after the deadline. There is information about how many days are after the date, the amount to pay, etc. and there is a button to settle cash arrears.

<img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/naleznosci-admin.PNG style="width: 400px"/>  <img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/rozliczenie-admin.PNG style="width: 400px"/>

<br>

- **Reports**

The last page on the internal side provides different reports like all borrows ever made, all returns, paid receivables, extends, and the status of books in the library at the current date. All can be sorted and searched.

<img src=https://github.com/HelloNatalia/systemBiblioteczny/blob/readmeimages/raporty-wypo%C5%BCyczenia-admin.PNG style="width: 400px"/>

<br>

## 💻 Used technologies
<br>

- **Yii Framework 2.0**<br>
It is an MVC PHP web application framework.
- **Bootstrap 5**
- **PHP 8**


- **Database** - MariaDB (phpMyAdmin)


- **Extensions used**
  - Select2 - Krajee Yii Extensions - Kartik - [Link](https://demos.krajee.com/widget-details/select2)
  - DatePicker - Class yii\jui\DatePicker - [Link](https://www.yiiframework.com/extension/yiisoft/yii2-jui/doc/api/2.0/yii-jui-datepicker)

<br>

## ⚙️ Installation
- [ ]  Add unpacked files into a created folder inside xampp/htdocs
- [ ] Open IDE you use and open created folder in the terminal (go into yii-application)
- [ ] Command: 
```composer create-project```
(If you don't have composer you need to install it first)
- [ ] Command: 
```php init```
(to initialize project)
- [ ] Now you have this project working but there is an error with the database, so go into **common/config/main-local.php** and write the name of your database.
My database file is [here](https://github.com/HelloNatalia/systemBiblioteczny/blob/main/library.sql). Insert this SQL into a new database in phpMyAdmin (remember, the name of the database must be the same as you inserted into main-local.php file)

**🎉 Congratulations, the project is working! 🎉**

<br>

## 💡 Hints for using the application

### Creating a new admin user

You can create a new Admin user by logging in at the client side by super admin account:

In the database it's:


ID: ```15```
Password: ```adminpassword```


When you are logged in you have to click on the link for creating admin named "Dodaj nowego admina" and fill in the form.

<br>


## 😎 What have I learned?

This is my first Yii2 application that I've developed independently. Throughout this project, I honed my skills in this framework and in PHP overall. I faced numerous challenges, but I successfully resolved them.



