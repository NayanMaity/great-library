<h1>Online-Library-Management-System-PHP-AJAX</h1>

<p>This is a simple Online-Library-Management-System for Great Library. Online library Management System divided in two modules such as–</p>

<ul>
    <li>Admin Module</li>
    <li>Student Module</li>
</ul>
<br>
<br>
<p><strong>Admin Features:</strong></p>

<ul>
    <li>Admin Dashboard</li>
    <li>Admin can add/update/ delete category</li>
    <li>Admin can add/update/ delete author</li>
    <li>Admin can add/update/ delete books</li>
    <li>Admin can issue a new book to student and also update the details when student return book</li>
    <li>Admin can search student by using their student ID</li>
    <li>Admin can also view student details</li>
    <li>Admin can change own password</li>
</ul>

<br>
<br>
<p><strong>Student Features:</strong></p>

<ul>
    <li>Student can register yourself and after registration they will get studentid</li>
    <li>After login student can view own dashboard.</li>
    <li>Stduent can also view the listed books in the library.</li>
    <li>Student can update own profile.</li>
    <li>Student can view issued book and book return date-time.</li>
    <li>Student can also change own password.</li>
</ul>

<br>
<br>

<p><strong>Database:</strong></p>
<br>
<p>
    Name: great_library_db
    <ul>
        Tables:
        <li>user</li>
        <li>categories</li>
        <li>author</li>
        <li>books</li>
        <li>issue</li>
    </ul>
</p>

<br>
<ul>
    user table:
    <li>user_id(int 11, primary key)</li>
    <li>user_name(varchar 255)</li>
    <li>user_email(varchar 255)</li>
    <li>user_pass(varchar 255)</li>
    <li>user_avatar(varchar 255)</li>
    <li>user_role(enum -> user, admin)</li>
    <li>user_show(enum -> 0, 1)</li>
    <li>token(null)</li>
    <li>create_user_data(varchar 255)</li>
    <li>update_user_data(varchar 255)</li>
</ul>

<br>
<ul>
    category table:
    <li>cate_id(int 11, primary key)</li>
    <li>cate_name(varchar 255)</li>
    <li>cate_desc(varchar 255)</li>
    <li>cate_show(enum -> 0, 1)</li>
    <li>create_cate_data(varchar 255)</li>
    <li>update_cate_data(varchar 255)</li>
</ul>

<br>
<ul>
    author table:
    <li>author_id(int 11, primary key)</li>
    <li>author_name(varchar 255)</li>
    <li>author_show(enum -> 0, 1)</li>
    <li>create_author_data(varchar 255)</li>
    <li>update_author_data(varchar 255)</li>
</ul>

<br>
<ul>
    book table:
    <li>book_id(int 11, primary key)</li>
    <li>book_title(varchar 255)</li>
    <li>book_desc(varchar 255)</li>
    <li>book_img(varchar 255)</li>
    <li>author_id(refarance form author table)</li>
    <li>cate_id(refarance form category table)</li>
    <li>book_show(enum -> 0, 1)</li>
    <li>create_book_data(varchar 255)</li>
    <li>update_book_data(varchar 255)</li>
</ul>


<br>
<ul>
    issue table:
    <li>issue_id(int 11, primary key)</li>
    <li>book_id(refarance form books table)</li>
    <li>user_id(refarance form user table)</li>
    <li>issue_status(enum-> not return, return)</li>
    <li>issue_show(enum -> 0, 1)</li>
    <li>issue_date(varchar 255)</li>
    <li>return_date(varchar 255)</li>
    <li>returned_at(varchar 255)</li>
</ul>

