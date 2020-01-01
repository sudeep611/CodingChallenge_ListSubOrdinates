Coding Challenge - Finding the Sub-Ordinates of Sub-Ordinates

## Coding Challenge Given Information
For Role - There are id and name defined for each role along with their parent to whom they report to. \
For Users - Unique set of id, name and role are defined to Each users 

### Sample Data
```
"roles" : [
  {
    "Id": 1,
    "Name": "System Administrator",
    "Parent": 0
  },
    {
      "Id": 2,
      "Name": "Location Manager",
      "Parent": 1
    },
    {
      "Id": 3,
      "Name": "Supervisor",
      "Parent": 2
    },
    {
      "Id": 4,
      "Name": "Employee",
      "Parent": 3
    },
    {
      "Id": 5,
      "Name": "Trainer",
      "Parent": 3
    }
],
  "users" : [
    {
      "Id": 1,
      "Name": "Adam Admin",
      "Role": 1
    },
    {
      "Id": 2,
      "Name": "Emily Employee",
      "Role": 4
    },
    {
      "Id": 3,
      "Name": "Sam Supervisor",
      "Role": 3
    },
    {
      "Id": 4,
      "Name": "Mary Manager",
      "Role": 2
    },
    {
      "Id": 5,
      "Name": "Steve Trainer",
      "Role": 5
    }
  ]
```

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

First: Create a subordinate table containing role id and their respective parent id as follows: \

For example in the above sample data, the role Supervisor with id 3 have a parent 2 which is Location Manager. 

| Role Id  | Parent Role Id |
| ---      | ---            |
| 1        | 0              |
| 2        | 1              |
| 3        | 2              |
| 4        | 3              |
| 5        | 3              |

Second: From the input which is user id, get the role id of that user. Example: If the input as a user id is 2 then the role id is 4 for Emily Employee.\

Third: Search the Subordinates in the role data from the role table recursively. \

Fourth: Return the data in the desired format.

### Decisions and tradeoffs
1. Composer is used in order to hanlde the project if it grows larger
1. Use of Object Oriented PHP to make code more reusable and maintainable
1. Use of recursive function in order to write shorter code and save memory space
1. Followed PSR-12 standard in the code to make it globally acceptable and understood by other developers


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
