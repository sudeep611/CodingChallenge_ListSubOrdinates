## Coding Challenge - Finding Sub Ordinates
We are given the list of Roles and Users containing following information in each:

For Role: Id, Name and Parent\
For Users: Id, Name and Role

We have to find the Users SubOrdinates and their SubOrdinates

### Assumptions
1. Each role and user have their own unique ids
1. A single role does not have multiple Parent to whom they report to
1. Each user is assigned a single role
1. Role id 1 with name "System Administrator" is the top level user and have to parent defined, hence it has parent as 0

### Solution Breakdown
1. Get the RoleId of the User
1. Find the Subordinates and their subordinates of the Role Recursively
1. List the users with the Roles obtained from Step 2
1. Print the Information

### Decisions and tradeoffs
1. Composer is used in order to hanlde the project if it grows larger
1. Use of Object Oriented PHP to make code more reusable and maintainable
1. Use of recursive function in order to write shorter code and save memory space
1. Followed PSR-12 standard in the code to make it globally acceptable and understood by other developers

### Tools Used
1. PHP Composer
1. PHPUnit (For testing)

### Running the Application
(Assuming that the php is installed in the machine)

1. Clone the project
```$ git clone https://github.com/sudeep611/CodingChallenge_ListSubOrdinates.git```

1. Navigate to directory
```$ cd CodingChallenge_ListSubOrdinates```

1. Install Composer in currrent directory
```$ composer install```

1. Run the PHP Server
```$ php -S localhost:4000```


### Running the test
(Assuming that the phpunit is installed in the machine)\
```$ phpunit tests/UserRoleTest.php```

### If project grows bigger
1. Database to be used for the data such as RDBMS rather than using the data in file format. 
