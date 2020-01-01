Coding Challenge - Finding the Sub-Ordinates of Sub-Ordinates

## Coding Challenge Given Information
For Role - There are id and name defined for each role along with their parent to whom they report to. \
For Users - Unique set of id, name and role are defined to Each users 

The data sample for Role and Users is as follows:\

### Task
1. Input: userId (Unique id of the user) 
1. Output: List of ALL user's subordinates (including their subordinate's subordinates)

Example: In the above sample, if input as a user id is 3 the output should be:\
```
[{"Id": 2,"Name": "Emily Employee","Role": 4}, {"Id": 3,"Name": "Sam Supervisor","Role": 3},
{"Id": 4,"Name": "Mary Manager","Role": 2}, {"Id": 5, "Name": "Steve
Trainer","Role": 5}]
```

### Assumptions
1. Each role and user have their own unique ids
1. A single role does not have multiple Parent to whom they report to
1. Each user is assigned a single role
1. Role id 1 with name "System Administrator" is the top level user and have to parent defined, hence it has parent as 0

## Solution Breakdown
1. 

### Decisions and tradeoffs

### Running the Application
(Assuming that the php is installed in the machine)\

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
```$ phpunit --bootstrap vendor/autoload.php tests/UserRoleTest.php```

### Contact 
For any inquiry mailto sudeep611@gmail[.]com
