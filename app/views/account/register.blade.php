<html>
    <head>


    </head>
    <body>

        <h2>Register form</h2>

        <form action="/api/account/registration" method="POST" name="registration-data">

            <input type="text" name="email" placeholder="Email..." id="email"/>

            <input type="password" name="password" placeholder="Password..." id="password"/>
            <input type="text" name="username" placeholder="Username" id="username"/>
            <input type="text" name="first_name" placeholder="First name" id="first_name"/>
            <input type="text" name="last_name" placeholder="Last name" id="last_name"/>
            <input type="submit" id="sbn-btn"/>

        </form>


    </body>
</html>