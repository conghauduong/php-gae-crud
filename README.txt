COSC2638 CLOUD COMPUTING ASSIGNMENT 1
STUDENT : DUONG CONG HAU 
ID : 3594990    
DEPLOYMENT URL: https://cloud3594990.appspot.com

APPLICATION SUMMARIZE:

This PHP Application covers all the requirements of assessment details.

THERE IS 3 SEPARATE PAGES IN THIS APPLICATION:

1. Manage Lecturers (CRUD table list view with custom pagination and bootstrap for UI)

    This is the main page of the application. This page contains a table with the list of lecturers retrieve
    from bucket storage file 'lecturers.csv', this list show the max 10 entries for better visual so user can go 
    between pages with pagination.
   

    All the html form are stored in the <views> directory and the actions are located in the <actions> folder

    ADD LECTURER
    As bucket storage does not allow appending file, every time we add a new lecturers, the application store 
    all data the previous csv file and add the new data from user input to the end of the Array and then overwrite
    the file with new data (previous data + input data). There is a view page (form_add_lecturer) for the form and a add 
    action (action_add_lecturer) for this CREATE function.

    Form fields are required and can not leave blank, lecturer ID field (have to be < 9999999) and age field (<120) allows only number.

    EDIT LECTURER
    To retrive data of lecturer, I create a item line variables of the list, after clicking edit, the line number will be passed
    to the pext views (form_edit_lecturer). Then the session will get all information of the current lecturers by lineNum tag and
    display the value into the input form. If user edit the form, the app get the input from the form and use 'post' method but 
    this time it will overwrite the data of the current lecturer from file. 

    DELETE
    The same as edit, the line number variables will tell which line of the list to be delete and remove the line from the data.

    For all action Add, Edit and Delete, after perform the action or cancel, users will be redirected to the page before they click on the
    action button with custom redirect url. For Add action, after add, user will be redirect to the page with newly added lecturer.  
    This also applies to Delete, if last entry is 11, which user is currently in page 2, after delete, user will be redirected to page 1.

    This page also display the total number of data entries ( total lecturers) from the file, when entries >= 10, the page will allow
    pagination to go to next or previous page, if user is at the first page, the previous button is disable. The same for the last page,
    the next button is disable to prevent displaying of empty data.

    'Export CSV' button is created for easier access to the csv file. This contains with the bucket file link.

2. Baby names    
    This page get the 10 Queries from the 'baby_names' table on BigQuery, contains a table list of baby names(Name, Gender, Frequency, Year)
     as the same as the Lecturer List.

3. Big Query (this is an extra page, can be disabled in header.php layout)
   This page contains a list of lecturers from bucket storage with a frequency column commensurate with the name of the lecturer.
   This page takes a bit to load 


